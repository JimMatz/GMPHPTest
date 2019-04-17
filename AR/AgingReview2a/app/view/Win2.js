/*
 * File: app/view/Win2.js
 *
 * This file was generated by Sencha Architect version 4.2.5.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Ext JS 6.6.x Classic library, under independent license.
 * License of Sencha Architect does not include license for Ext JS 6.6.x Classic. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('MyApp.view.Win2', {
    extend: 'Ext.window.Window',
    alias: 'widget.win2',

    requires: [
        'MyApp.view.Win2ViewModel',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.grid.column.Column'
    ],

    viewModel: {
        type: 'win2'
    },
    height: 442,
    id: 'win2',
    width: 912,
    layout: 'fit',
    title: 'Properties for ',
    defaultListenerScope: true,

    items: [
        {
            xtype: 'gridpanel',
            id: 'gridDefaults',
            bind: {
                store: 'store_Defaults'
            },
            columns: [
                {
                    xtype: 'gridcolumn',
                    hidden: true,
                    dataIndex: 'USR',
                    text: 'User'
                },
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'TAG',
                    text: 'Property'
                },
                {
                    xtype: 'gridcolumn',
                    width: 186,
                    dataIndex: 'TAGD',
                    text: 'Description'
                },
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'TAGV',
                    text: 'Value'
                },
                {
                    xtype: 'gridcolumn',
                    hidden: true,
                    dataIndex: 'TAGACTIVE',
                    text: 'Active'
                },
                {
                    xtype: 'gridcolumn',
                    width: 50,
                    align: 'center',
                    dataIndex: 'TAGTYPE',
                    text: 'Type'
                }
            ],
            listeners: {
                afterrender: 'onGridpanelAfterRender',
                rowdblclick: 'onGridDefaultsRowDblClick'
            }
        }
    ],
    listeners: {
        close: 'onWin2Close'
    },

    onGridpanelAfterRender: function(component, eOpts) {
        Ext.Ajax.request({
           url: 'http://192.168.100.80:10088/Gemini/AR/getCurUser.php?DB=GI',
           success: function(response, opts) {
              var src = Ext.decode(response.responseText);
               console.log('Source ',src);
               Ext.getCmp('win2').setTitle('Proprties for ' + src);

           }
        });
    },

    onGridDefaultsRowDblClick: function(tableview, record, element, rowIndex, e, eOpts) {
        winName = 'win1' + Ext.String.trim(record.data.TAG) ;
        formName = 'form1' + Ext.String.trim(record.data.TAG) ;
        w1 = Ext.getCmp(winName);
        if (w1) {
            w1.close();
        }


        if (record.data.TAGTYPE == 'D'){
            tagv = Ext.Date.parse(Ext.String.trim(record.data.TAGV),'Y-m-d');
            var field = {
                xtype: 'datefield',
                anchor: '100%',
                submitFormat: 'Y-m-d',
                fieldLabel: Ext.String.trim(record.data.TAGD),
                name: 'TAGV'
            };

        } // end D types

        if (record.data.TAGTYPE == 'S'){
            tagv = Ext.String.trim(record.data.TAGV);
            var field = {
                xtype: 'textfield',
                anchor: '100%',

                fieldLabel: Ext.String.trim(record.data.TAGD),
                name: 'TAGV'
            };

        } // end S types

        if (record.data.TAGTYPE == 'N'){
            tagv = Ext.String.trim(record.data.TAGV);
            var field = {
                xtype: 'numberfield',
                anchor: '100%',

                fieldLabel: Ext.String.trim(record.data.TAGD),
                name: 'TAGV'
            };

        } // end n types

        if (record.data.TAGTYPE == 'B'){
            if (Ext.String.trim(record.data.TAGV) == 'Y'){
                tagv = 'on';
            } else {
                tagv = 'off';
            }
            var field = {
                xtype: 'checkboxfield',
                anchor: '100%',

                boxLabel: 'Include ' + Ext.String.trim(record.data.TAGD),
                uncheckedValue: 'N',
                name: 'TAGV'
            };


        } // end B types




        if (record.data.TAGTYPE == 'C'){
            tagv = Ext.String.trim(record.data.TAGV);
            console.log('Color: ', tagv);
            tagv2 = Ext.String.trim(record.data.TAGV);
            tagv2 = tagv2.substring(1,6);

            cm = new Ext.create('Ext.picker.Color', {
                //   value: tagv2,  // initial selected color
                //    renderTo: Ext.getBody(),
                listeners: {
                    select: function(picker, selColor) {
                        theForm.findField('TAGV').setValue('#' + selColor);
                    }
                }
            });

            var field = {
                xtype: 'textfield',
                fieldLabel: 'Selected Color',
                name: 'TAGV',
                readOnly: true

            };






        } // end C types




        var win1 = new Ext.create ('Ext.window.Window' , {
            alias: 'widget.' + winName,
            requires: [
                'MyApp.view.Win1ViewModel',
                'Ext.form.Panel',
                'Ext.form.field.Hidden',
                'Ext.form.field.Text'
            ],


            height: 461,
            width: 431,
            layout: 'fit',


            title: 'My Window',
            id: winName,
            defaultListenerScope: true,

            items: [
                {
                    xtype: 'form',
                    id: formName,
                    bodyPadding: 10,
                    url: '/Gemini/AR/SetDefault.php?DB=GI',

                    items: [
                        {
                            xtype: 'hiddenfield',
                            anchor: '100%',

                            fieldLabel: 'Label',
                            name: 'USR'
                        },
                        {
                            xtype: 'hiddenfield',
                            anchor: '100%',

                            fieldLabel: 'Label',
                            name: 'TAG'
                        },
                        {
                            xtype: 'textfield',
                            anchor: '100%',

                            fieldLabel: 'Description',
                            name: 'TAGD',
                            listeners: {
                                click: function(component, event, eOpts) {
                                    console.log('valueChanged');
                                }
                            }
                        },
                        {
                            xtype: 'hiddenfield',
                            anchor: '100%',

                            fieldLabel: 'Label',
                            name: 'TAGACTIVE'
                        },
                        {
                            xtype: 'hiddenfield',
                            anchor: '100%',

                            fieldLabel: 'Label',
                            name: 'TAGTYPE'
                        },
                        field
                    ]
                }
            ]

        });


        win1.show ();
        form = Ext.getCmp(formName);
        theForm = form.getForm();

        theForm.findField('USR').setValue(record.data.USR);
        theForm.findField('TAG').setValue(record.data.TAG);
        theForm.findField('TAGD').setValue(record.data.TAGD);
        theForm.findField('TAGACTIVE').setValue(record.data.TAGACTIVE);
        theForm.findField('TAGTYPE').setValue(record.data.TAGTYPE);

        console.log('tag value: ',record.data.TAGV );
        theForm.findField('TAGV').setValue(tagv);

        win1.setTitle('Set Property Value for ' + record.data.TAGD);

        //form = Ext.getCmp('formProp');



        //if (record.data.TAGTYPE == 'B'){
        //    if (Ext.String.trim(record.data.TAGV) == 'Y'){
        //        tagv = 'on';
        //    } else {
        //        tagv = 'off';
        //    }
        //   form.add(new Ext.form.Checkbox({
        //        anchor: '100%',
        //
        //        boxLabel: 'Include ' + Ext.String.trim(record.data.TAGD),
        //
        //        name: 'TAGV'
        //    }));
        //    console.log('tag value: ',record.data.TAGV );
        //    theForm.findField('TAGV').setValue(tagv);
        //} // end B types


        if (record.data.TAGTYPE == 'C'){
            tagv = Ext.String.trim(record.data.TAGV);
            console.log('Color: ', tagv);
            tagv2 = Ext.String.trim(record.data.TAGV);
            tagv2 = tagv2.substring(1,6);

            cm = new Ext.create('Ext.picker.Color', {
                //   value: tagv2,  // initial selected color
                //    renderTo: Ext.getBody(),
                listeners: {
                    select: function(picker, selColor) {
                        theForm.findField('TAGV').setValue('#' + selColor);
                    }
                }
            });





            form.add(cm);


        } // end C types


        form.add(
            new Ext.button.Button(
                {fieldLabel:'Save',
                 text:'Save',
                 iconCls: 'x-fa fa-download',

                 handler: function () {
                     var theForm = Ext.getCmp(formName).getForm();
                     console.log('Save Button Pushed: ' ,theForm);

                     if (theForm.isValid()) {
                         theForm.submit({
                             success: function (form, action) {
                                 // Ext.Msg.alert('Success', action.result.message);
                                 Ext.getCmp(winName).close();
                                 Ext.getStore('store_Defaults').load();

                             },
                             failure: function (form, action) {
                                 Ext.Msg.alert('Failed', action.result ? action.result.message : 'No response');
                             }
                         });
                     }


                 }


                }));

    },

    onWin2Close: function(panel, eOpts) {
        window.location.reload();
    }

});