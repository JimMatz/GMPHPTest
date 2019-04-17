/*
 * File: app/controller/MyController.js
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

Ext.define('MyApp.controller.MyController', {
    extend: 'Ext.app.Controller',

    init: function(application) {
        console.log('setting state manager');
        Ext.state.Manager.setProvider(new Ext.state.CookieProvider({
                            expires: new Date(new Date().getTime() + (1000 * 60 * 60 * 24 * 7)), //7 days from now
                        }));

    },

    crtEditWin: function(data) {
        console.log(data);



        winName =  'Win_' + Ext.String.trim(data.USR);
        formName = 'form_' +  Ext.String.trim(data.USR);

        if (data.TAGTYPE == 'D'){
            $data = Ext.create('Ext.form.field.Date', {
                id: winName + 'TAGV',
                            padding: 5,
                            fieldLabel: 'Value',
                            name: 'TAGV',

                            allowBlank: false,
                            enforceMaxLength: true,
                            value: Ext.String.trim(data.TAGV),
                            maxLength: 50
            });


        }


        Ext.create('Ext.window.Window', {


            requires: [
                'MyApp.view.MyWindowViewModel',
                'Ext.panel.Panel',
                'Ext.form.field.Text',
                'Ext.form.FieldSet',
                'Ext.button.Button'
            ],

            viewModel: {
                type: 'mywindow'
            },
            height: 702,
            width: 1217,
            title:    winName ,
            id: winName,
            defaultListenerScope: true,

            items: [
                {
                    xtype: 'form',
                    height: 576,
                    id: formName,
                    url: '/Gemini/ARSetDefaults.php?DB=GI',
                    layout: 'column',
                    items: [
                        {
                            xtype: 'textfield',
                            id: winName + 'USR',
                            padding: 5,
                            fieldLabel: 'User',
                            name: 'USR',
                            hiddend: true,
                            allowBlank: false,
                            enforceMaxLength: true,
                            value: Ext.String.trim(data.USR),
                            maxLength: 50
                        },
                        {
                            xtype: 'textfield',
                            id: winName +'TAG',
                            padding: 5,
                            fieldLabel: 'Property',
                            name: 'TAG',
                            readOnly: true,
                            value: Ext.String.trim(data.TAG),
                            enforceMaxLength: true,
                            maxLength: 10
                        },{
                            xtype: 'textfield',
                            id: winName + 'TAGD',
                            padding: 5,
                            fieldLabel: 'Descriptiopn',
                            name: 'TAGD',
                            readOnly: true,
                            allowBlank: false,
                            enforceMaxLength: true,
                            value: Ext.String.trim(data.TAGD),
                            maxLength: 50
                        },
                        {
                            xtype: 'textfield',
                            id: winName + 'TAGTYPE',
                            padding: 5,
                            fieldLabel: 'Type',
                            name: 'TAGTYPE',
                            hiddend: true,
                            allowBlank: false,
                            enforceMaxLength: true,
                            value: Ext.String.trim(data.TAGTYPE),
                            maxLength: 50
                        },{
                            xtype: 'textfield',
                            id: winName + 'TAGACTIVE',
                            padding: 5,
                            fieldLabel: 'Active',
                            name: 'TAGACTIVE',
                            hiddend: true,
                            allowBlank: false,
                            enforceMaxLength: true,
                            value: Ext.String.trim(data.TAGACTIVE),
                            maxLength: 50
                        }



                    ],
                    listeners: {
                        afterrender: function(component, eOpts) {
                            if (data.TAGTYPE == 'D'){
            $data = Ext.create('Ext.form.field.Date', {
                id: winName + 'TAGV',
                            padding: 5,
                            fieldLabel: 'Value',
                            name: 'TAGV',

                            allowBlank: false,
                            enforceMaxLength: true,
                            value: Ext.String.trim(data.TAGV),
                            maxLength: 50
            });
        this.form.add($data);

        }

                        }
                    }
                },
                {
                    xtype: 'button',
                    text: 'Submit',
                    handler: function() {
                        var form = Ext.getCmp(formName).getForm(formName); // get the form panel
                        if (form.isValid()) { // make sure the form contains valid data before submitting
                            form.submit({
                                success: function(form, action) {
                                    Ext.Msg.alert('Success', action.result.msg);
                                    Ext.getCmp(winName).close();
                                    Ext.getStore('MyJsonStore').load();
                                },
                                failure: function(form, action) {
                                    Ext.Msg.alert('Failed', action.result.msg);
                                }
                            });
                        } else { // display error alert if the data is invalid
                            Ext.Msg.alert('Invalid Data', 'Please correct form errors.');
                        }
                    }
                }
            ],



        }).show();

    }

});
