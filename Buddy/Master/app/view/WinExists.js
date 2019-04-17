/*
 * File: app/view/WinExists.js
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

Ext.define('MyApp.view.WinExists', {
    extend: 'Ext.window.Window',
    alias: 'widget.winExists',

    requires: [
        'MyApp.view.WinExistsViewModel',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.grid.column.Number',
        'Ext.grid.filters.filter.Number',
        'Ext.grid.column.Date',
        'Ext.grid.filters.Filters'
    ],

    viewModel: {
        type: 'winexists'
    },
    height: 738,
    id: 'winExists',
    width: 462,
    layout: 'fit',
    title: 'Processed Orders',
    defaultListenerScope: true,

    items: [
        {
            xtype: 'gridpanel',
            bind: {
                store: 'storeReview'
            },
            columns: [
                {
                    xtype: 'numbercolumn',
                    align: 'end',
                    dataIndex: 'ORDERNUM',
                    text: 'Order',
                    format: '00',
                    filter: {
                        type: 'number'
                    }
                },
                {
                    xtype: 'numbercolumn',
                    align: 'end',
                    dataIndex: 'QTY',
                    text: 'Quantity',
                    format: '00'
                },
                {
                    xtype: 'numbercolumn',
                    align: 'end',
                    dataIndex: 'SCANCNT',
                    text: 'Scanned',
                    format: '00'
                },
                {
                    xtype: 'datecolumn',
                    align: 'end',
                    dataIndex: 'LASTSCAN',
                    text: 'Last <br> Scanned',
                    format: 'm/j/Y'
                }
            ],
            listeners: {
                rowdblclick: 'onGridpanelRowDblClick'
            },
            plugins: [
                {
                    ptype: 'gridfilters'
                }
            ]
        }
    ],

    onGridpanelRowDblClick: function(tableview, record, element, rowIndex, e, eOpts) {
        var ord = record.data.ORDERNUM;
        Ext.getCmp('ord').setValue(ord);

        Ext.Ajax.request({
            url: '/Gemini/Buddy/getCust.php?DB=GI&ORD=' + ord  ,
            method: 'GET',
            async: false,
            success: function(response, opts) {
                //  console.log(response);
                var obj = response.responseText;
                // console.log(obj);
                // Ext.getStore('MyJsonStore').load();
                Ext.getCmp('pnlMain').setTitle('Buddy Check Components for ' + obj);

                Ext.Ajax.request({
                    url: '/Gemini/Buddy/getCpy.php?DB=GI&ORD=' + ord  ,
                    method: 'GET',
                    async: false,
                    success: function(response, opts) {
                        //  console.log(response);
                        var obj = response.responseText;
                        console.log('copy count: ', obj);
                        Ext.getCmp('copy').setVisible(true);
                        Ext.getCmp('copy').setValue(obj);

                    },

                    failure: function(response, opts) {
                        console.log(response);
                        //  console.log('server-side failure with status code ' + response.status);
                    }
                });


            },

            failure: function(response, opts) {
                console.log(response);
                //  console.log('server-side failure with status code ' + response.status);
            }
        });

        Ext.getCmp('btnPrint').setVisible(true);
        Ext.getCmp('reset').setVisible(true);
        store = Ext.getStore('storeM');
        store.load({
            params:{
                ORD: ord
            }
        });
    }

});