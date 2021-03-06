/*
 * File: app/store/storeD.js
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

Ext.define('MyApp.store.storeD', {
    extend: 'Ext.data.Store',

    requires: [
        'MyApp.model.modelD',
        'Ext.data.proxy.Ajax',
        'Ext.data.reader.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'storeD',
            autoSync: true,
            model: 'MyApp.model.modelD',
            proxy: {
                type: 'ajax',
                url: '/Gemini/Buddy/GetBuddyD.php',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            }
        }, cfg)]);
    }
});