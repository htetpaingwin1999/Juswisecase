/**
 * Copyright (c) Tiny Technologies, Inc. All rights reserved.
 * Licensed under the LGPL or a commercial license.
 * For LGPL see License.txt in the project root for license information.
 * For commercial licenses see https://www.tiny.cloud/
 */

import Editor from 'tinymce/core/api/Editor';

const getTocClass = (editor: Editor): string =>
  editor.getParam('toc_class', 'mce-toc');

const getTocHeader = (editor: Editor): string => {
  const tagName = editor.getParam('toc_header', 'h2');
  return /^h[1-6]$/.test(tagName) ? tagName : 'h2';
};

const getTocDepth = (editor: Editor): number => {
  const depth = parseInt(editor.getParam('toc_depth', '3'), 10);
  return depth >= 1 && depth <= 9 ? depth : 3;
};

export {
  getTocClass,
  getTocHeader,
  getTocDepth
};
