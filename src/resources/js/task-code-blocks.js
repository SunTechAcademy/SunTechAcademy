import { Extension } from '@tiptap/core';
import { Plugin } from '@tiptap/pm/state';

// Converting several paragraphs can produce one code block per paragraph.
// Join touching blocks with a newline, retaining selection and undo history.
export const ContinuousCodeBlocks = Extension.create({
    name: 'continuousCodeBlocks',
    addProseMirrorPlugins() {
        return [new Plugin({
            appendTransaction(transactions, oldState, state) {
                if (!transactions.some(transaction => transaction.docChanged || transaction.getMeta('normalizeTaskCodeBlocks'))) return null;
                const boundaries = [];
                state.doc.descendants((node, position, parent, index) => {
                    if (node.type.name !== 'codeBlock' || index === 0) return;
                    const previous = parent.child(index - 1);
                    if (previous.type === node.type && previous.attrs.language === node.attrs.language) boundaries.push(position);
                });
                if (!boundaries.length) return null;
                const transaction = state.tr;
                for (const position of boundaries.reverse()) {
                    transaction.insertText('\n', position - 1);
                    transaction.join(position + 1);
                }
                return transaction;
            },
        })];
    },
});
