/*
 * File: app/store/storeRgn.js
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

Ext.define('MyApp.store.storeRgn', {
    extend: 'Ext.data.Store',

    requires: [
        'MyApp.model.modelRgn',
        'Ext.data.proxy.Ajax',
        'Ext.data.reader.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            statefulFilters: true,
            storeId: 'storeRgn',
            autoLoad: true,
            autoSync: true,
            model: 'MyApp.model.modelRgn',
            proxy: {
                type: 'ajax',
                url: '/Gemini/AR/getAgeGroupsbyRegion.php?DB=GI',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            },
            listeners: {
                beforeload: {
                    fn: me.onJsonstoreBeforeLoad,
                    scope: me
                }
            }
        }, cfg)]);
    },

    onJsonstoreBeforeLoad: function(store, operation, eOpts) {
         var params = Ext.urlDecode(location.search.substring(1));
        console.log('Params: ', params);

        store.getProxy().extraParams = {
            RGN: params.RGN,
            GRP: params.GRP
        };

        store.setStatefulFilters(true);
    }

});