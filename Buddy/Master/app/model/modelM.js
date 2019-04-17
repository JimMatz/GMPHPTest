/*
 * File: app/model/modelM.js
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

Ext.define('MyApp.model.modelM', {
    extend: 'Ext.data.Model',

    requires: [
        'Ext.data.field.String',
        'Ext.data.field.Number'
    ],

    fields: [
        {
            type: 'int',
            name: 'ORDERNUM'
        },
        {
            type: 'int',
            name: 'CMPSEQ'
        },
        {
            type: 'string',
            name: 'COMPONENT'
        },
        {
            type: 'string',
            name: 'CMPID'
        },
        {
            type: 'float',
            name: 'QTY'
        },
        {
            type: 'string',
            name: 'UOM'
        },
        {
            type: 'string',
            name: 'SEQSTATUS'
        },
        {
            type: 'string',
            name: 'CMPNOTES'
        }
    ]
});