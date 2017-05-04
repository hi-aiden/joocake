/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    var path = CKEDITOR.basePath.split('/');

    path[ path.length-2 ] = 'upload_image';

    config.toolbarGroups = [
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'colors', groups: [ 'colors' ] },
        { name: 'tools', groups: [ 'tools' ] },
        { name: 'others', groups: [ 'others' ] },
        { name: 'about', groups: [ 'about' ] },
        { name: 'forms', groups: [ 'forms' ] },
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
        { name: 'links', groups: [ 'links' ] },
        { name: 'insert', groups: [ 'insert' ] },
    ];

    config.removeButtons = 'Save,NewPage,Preview,Print,PasteFromWord,PasteText,Paste,Copy,Cut,Find,Replace,SelectAll,Scayt,Flash,PageBreak,Iframe,Styles,About,CopyFormatting,Language';

    config.language = 'ko';
    config.height = 300;
    config.toolbarCanCollapse = true;
    config.resize_enabled = true;
    config.enterMode = CKEDITOR.ENTER_BR;
    config.shiftEnterMode = CKEDITOR.ENTER_P;

    config.font_names = '나눔고딕/Nanum Gothic;굴림/Gulim;돋움/Dotum;바탕/Batang;궁서/Gungsuh;Arial/Arial;Comic Sans MS/Comic Sans MS;Courier New/Courier New;Georgia/Georgia;Lucida Sans Unicode/Lucida Sans Unicode;Tahoma/Tahoma;Times New Roman/Times New Roman;Trebuchet MS/Trebuchet MS;Verdana/Verdana';
    config.fontSize_defaultLabel = '12px';
    config.fontSize_sizes = '8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;';

    config.filebrowserUploadUrl = path.join('/').replace(/\/+$/, '');
    config.extraPlugins = 'filebrowser';


    // Rails CSRF token
    config.filebrowserParams = function(){
        var csrf_token, csrf_param = '_token', meta,
            metas = document.getElementsByTagName('meta'),
            params = new Object();

        for ( var i = 0 ; i < metas.length ; i++ ){
            meta = metas[i];

            switch(meta.name) {
                case "csrf-token":
                    csrf_token = meta.content;
                    break;
                default:
                    continue;
            }
        }

        if (csrf_token !== undefined) {
            params[csrf_param] = csrf_token;
        }

        return params;
    };

    config.addQueryString = function( url, params ){
        var queryString = [];

        if ( !params ) {
            return url;
        } else {
            for ( var i in params )
                queryString.push( i + "=" + encodeURIComponent( params[ i ] ) );
        }

        return url + ( ( url.indexOf( "?" ) != -1 ) ? "&" : "?" ) + queryString.join( "&" );
    };

    // Integrate Rails CSRF token into file upload dialogs (link, image, attachment and flash)
    CKEDITOR.on( 'dialogDefinition', function( ev ){
        // Take the dialog name and its definition from the event data.
        var dialogName = ev.data.name;
        var dialogDefinition = ev.data.definition;
        var content, upload;

        if (CKEDITOR.tools.indexOf(['link', 'image', 'attachment', 'flash'], dialogName) > -1) {
            content = (dialogDefinition.getContents('Upload') || dialogDefinition.getContents('upload'));
            upload = (content == null ? null : content.get('upload'));
            console.log(content)
            if (upload && upload.filebrowser) {
                upload.action = config.addQueryString(upload.action, config.filebrowserParams());
            }
        }
    });

};
