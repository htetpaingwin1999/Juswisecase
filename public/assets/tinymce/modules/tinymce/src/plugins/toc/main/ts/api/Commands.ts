/**
 * Copyright (c) Tiny Technologies, Inc. All rights reserved.
 * Licensed under the LGPL or a commercial license.
 * For LGPL see License.txt in the project root for license information.
 * For commercial licenses see https://www.tiny.cloud/
 */

import Editor from 'tinymce/core/api/Editor';

import * as Toc from '../core/Toc';

const register = (editor: Editor): void => {
  editor.addCommand('mceInsertToc', () => {
    Toc.insertToc(editor);
  });

  editor.addCommand('mceUpdateToc', () => {
    Toc.updateToc(editor);
  });
};

export {
  register
};
