/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    config.language = document.currLang;
    config.height = 300;
    config.toolbarCanCollapse = true;
    config.filebrowserUploadUrl = '/admin/upload/index/';
    config.extraPlugins = 'imagebrowser';
    config.imageBrowser_listUrl = '/admin/upload/browse/';
};
