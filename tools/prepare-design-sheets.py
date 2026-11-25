import json
from pathlib import Path
ROOT=Path(__file__).resolve().parents[1]
books=json.loads((ROOT/'docs/design/content.json').read_text())
OUT=Path('/tmp/academy-design-artifacts/requests'); OUT.mkdir(parents=True,exist_ok=True)
ids=['1lQxU8IBmf1GfjkClqQQp6hD-M6dntvdAfzwjr4Eo3qQ','1x6SHg0qwRfukNVU4Qsq-WLAXCAfl16xv0I8B5GnxaGE','1ZkaXjU1WRSRLrXGmGrVvoZprGCaZ6hCeeUVGCj_pGLI','1Dfh6Y66O_K1uGAaHmcM1wuRL2-OUCDomP9gfBGoC4jo','1K8XcPXTwwQtl90P6GBwBqXrbCUE4bYvByi2m2GvR5_Y','1zTgtF7cAZDetnEPrRV99Kwkq_dnt012_tqJokExMHAI','10j5T6Ro7UohA8_riikzBmaP92VKGd0Jz5fbldh1ApVI']
manifest=[]
for bi,b in enumerate(books):
    files=[]
    def save(label,requests):
        for r in requests: assert len(r)==1
        p=OUT/f'{bi}-{label}.json';p.write_text(json.dumps({'spreadsheet_id':ids[bi],'requests':requests},ensure_ascii=False));files.append(str(p))
    structure=[]
    for ti,t in enumerate(b['tabs']):
        sid=0 if ti==0 else 100+ti
        t['sheetId']=sid
        prop={'sheetId':sid,'title':t['name'],'gridProperties':{'rowCount':max(100,len(t['rows'])+20),'columnCount':max(12,len(t['headers'])),'frozenRowCount':1}}
        if ti==0:
            # Only rename the existing empty sheet and freeze its header; preserve unused grid.
            structure.append({'updateSheetProperties':{'properties':{'sheetId':0,'title':t['name'],'gridProperties':{'frozenRowCount':1}},'fields':'title,gridProperties.frozenRowCount'}})
        else: structure.append({'addSheet':{'properties':prop}})
    save('structure',structure)
    for ti,t in enumerate(b['tabs']):
        sid=t['sheetId'];rows=[t['headers']]+t['rows'];cols=len(t['headers'])
        for ri in range(0,len(rows),60):
            block=rows[ri:ri+60]
            assert all(len(row)==cols for row in block),(b['title'],t['name'])
            save(f'{ti}-values-{ri}',[{'updateCells':{'range':{'sheetId':sid,'startRowIndex':ri,'endRowIndex':ri+len(block),'startColumnIndex':0,'endColumnIndex':cols},'rows':[{'values':[{'userEnteredValue':{'numberValue':v} if isinstance(v,(int,float)) else {'stringValue':str(v)}} for v in row]} for row in block],'fields':'userEnteredValue'}}])
        rng={'sheetId':sid,'startRowIndex':0,'endRowIndex':len(rows),'startColumnIndex':0,'endColumnIndex':cols}
        requests=[{'repeatCell':{'range':rng,'cell':{'userEnteredFormat':{'backgroundColor':{'red':1,'green':1,'blue':1},'textFormat':{'fontFamily':'Arial','fontSize':11,'foregroundColor':{'red':0.12,'green':0.12,'blue':0.12}},'wrapStrategy':'WRAP','verticalAlignment':'TOP'}},'fields':'userEnteredFormat'}},
         {'repeatCell':{'range':dict(rng,endRowIndex=1),'cell':{'userEnteredFormat':{'backgroundColor':{'red':0.93,'green':0.93,'blue':0.93},'textFormat':{'bold':True}}},'fields':'userEnteredFormat.backgroundColor,userEnteredFormat.textFormat.bold'}}]
        for ci,w in enumerate(t['widths']): requests.append({'updateDimensionProperties':{'range':{'sheetId':sid,'dimension':'COLUMNS','startIndex':ci,'endIndex':ci+1},'properties':{'pixelSize':w},'fields':'pixelSize'}})
        if 'コード' in t['name']:
            requests.append({'repeatCell':{'range':dict(rng,startRowIndex=1,startColumnIndex=1),'cell':{'userEnteredFormat':{'textFormat':{'fontFamily':'Courier New','fontSize':10}}},'fields':'userEnteredFormat.textFormat.fontFamily,userEnteredFormat.textFormat.fontSize'}})
        requests.append({'autoResizeDimensions':{'dimensions':{'sheetId':sid,'dimension':'ROWS','startIndex':0,'endIndex':len(rows)}}})
        if len(rows)>15 and 'コード' not in t['name'] and t['name']!='はじめに': requests.append({'setBasicFilter':{'filter':{'range':rng}}})
        save(f'{ti}-format',requests)
    manifest.append({'id':ids[bi],'title':b['title'],'files':files,'tabs':[{'name':t['name'],'sheetId':t['sheetId'],'rows':len(t['rows'])+1,'cols':len(t['headers'])} for t in b['tabs']]})
(ROOT/'docs/design/sheet-plan.json').write_text(json.dumps(manifest,ensure_ascii=False,indent=2))
print('Prepared',sum(len(m['files']) for m in manifest),'bounded batches across',sum(len(m['tabs']) for m in manifest),'tabs')
