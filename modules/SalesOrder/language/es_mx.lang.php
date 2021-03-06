<?php
/*+********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ********************************************************************************
*  Module       : Sales Orders
*  Language     : Español
*  Version      : 5.4.0
*  Created Date : 2007-03-30
*  Author       : Rafael Soler
*  Last change  : 2012-02-27
*  Author       : Joe Bordes JPL TSolucio, S.L.
*  Author       : Francisco Hernandez Odin Consultores www.odin.mx
 ********************************************************************************/

$mod_strings = Array(
'LBL_MODULE_NAME'=>'Pedidos',
'LBL_SO_MODULE_NAME'=>'Pedidos',
'LBL_RELATED_PRODUCTS'=>'Elementos',
'LBL_MODULE_TITLE'=>'Pedidos: Inicio',
'LBL_SEARCH_FORM_TITLE'=>'Buscar Pedidos',
'LBL_LIST_SO_FORM_TITLE'=>'Lista de los Pedidos',
'LBL_NEW_FORM_SO_TITLE'=>'Nuevo Pedido',
'LBL_MEMBER_ORG_FORM_TITLE'=>'Organizaciones Miembro',

'LBL_LIST_ACCOUNT_NAME'=>'Nombre de la Cuenta',
'LBL_LIST_CITY'=>'Deleg./Mpio.',
'LBL_LIST_WEBSITE'=>'Página Web',
'LBL_LIST_STATE'=>'Estado',
'LBL_LIST_PHONE'=>'Teléfono',
'LBL_LIST_EMAIL_ADDRESS'=>'Email',
'LBL_LIST_CONTACT_NAME'=>'Persona de Contacto',

//DON'T CONVERT THESE THEY ARE MAPPINGS
'db_name' => 'LBL_LIST_ACCOUNT_NAME',
'db_website' => 'LBL_LIST_WEBSITE',
'db_billing_address_city' => 'LBL_LIST_CITY',

//END DON'T CONVERT

'LBL_ACCOUNT'=>'Cuenta:',
'LBL_ACCOUNT_NAME'=>'Nombre de la Cuenta:',
'LBL_PHONE'=>'Teléfono:',
'LBL_WEBSITE'=>'Página Web:',
'LBL_FAX'=>'Fax:',
'LBL_TICKER_SYMBOL'=>'Símbolo de bolsa:',
'LBL_OTHER_PHONE'=>'Tel. Directo:',
'LBL_ANY_PHONE'=>'Tel. Adicional:',
'LBL_MEMBER_OF'=>'Miembro de:',
'LBL_EMAIL'=>'Email:',
'LBL_EMPLOYEES'=>'Empleados:',
'LBL_OTHER_EMAIL_ADDRESS'=>'Email (Otro):',
'LBL_ANY_EMAIL'=>'Email (Alternativo):',
'LBL_OWNERSHIP'=>'Propietario:',
'LBL_RATING'=>'Valoración:',
'LBL_INDUSTRY'=>'Actividad:',
'LBL_SIC_CODE'=>'RFC:',
'LBL_TYPE'=>'Tipo:',
'LBL_ANNUAL_REVENUE'=>'Facturación Anual:',
'LBL_ADDRESS_INFORMATION'=>'Información de la Dirección',
'LBL_Quote_INFORMATION'=>'Información de la Cuenta',
'LBL_CUSTOM_INFORMATION'=>'Información personalizada',
'LBL_BILLING_ADDRESS'=>'Dirección (Factura:',
'LBL_SHIPPING_ADDRESS'=>'Dirección (Envío):',
'LBL_ANY_ADDRESS'=>'Dirección (Alternativa):',
'LBL_CITY'=>'Deleg./Mpio.:',
'LBL_STATE'=>'Estado:',
'LBL_POSTAL_CODE'=>'Código Postal:',
'LBL_COUNTRY'=>'País:',
'LBL_DESCRIPTION_INFORMATION'=>'Información adicional',
'LBL_TERMS_INFORMATION'=>'Condiciones Generales',
'LBL_DESCRIPTION'=>'Descripción:',
'NTC_COPY_BILLING_ADDRESS'=>'Copiar Factura a Entvío',
'NTC_COPY_SHIPPING_ADDRESS'=>'Copiar Entvío a Factura',
'NTC_REMOVE_MEMBER_ORG_CONFIRMATION'=>'¿Está seguro que desea quitar este expediente como organización del miembro?',
'LBL_DUPLICATE'=>'Posibles Cuentas Duplicadas ',
'MSG_DUPLICATE' => 'Al dar de alta esta cuenta puede que se cree una cuenta duplicada. Puede seleccionar una cuenta del listado inferior o hacer click en Crear Nueva Cuenta para continuar creando la cuenta con los datos introducidos.',

'LBL_INVITEE'=>'Contactos',
'ERR_DELETE_RECORD'=>'Debe especificar un registro para eliminar la cuenta.',

'LBL_SELECT_ACCOUNT'=>'Seleccionar Cuenta',
'LBL_GENERAL_INFORMATION'=>'Información General',

//for v4 release added
'LBL_NEW_POTENTIAL'=>'Nueva Oportunidad',
'LBL_POTENTIAL_TITLE'=>'Oportunidad',

'LBL_NEW_TASK'=>'Nueva Tarea',
'LBL_TASK_TITLE'=>'Tarea',
'LBL_NEW_CALL'=>'Nueva Llamada',
'LBL_CALL_TITLE'=>'Llamadas',
'LBL_NEW_MEETING'=>'Nueva Reunión',
'LBL_MEETING_TITLE'=>'Reuniones',
'LBL_NEW_EMAIL'=>'Nuevo Email',
'LBL_EMAIL_TITLE'=>'Emails',
'LBL_NEW_CONTACT'=>'Nuevo Contacto',
'LBL_CONTACT_TITLE'=>'Contactos',

//Added vtiger_fields after RC1 - Release
'LBL_ALL'=>'Toda',
'LBL_PROSPECT'=>'Investigador',
'LBL_INVESTOR'=>'Inversionista',
'LBL_RESELLER'=>'Revendedor',
'LBL_PARTNER'=>'Socio',

// Added for 4GA
'LBL_TOOL_FORM_TITLE'=>'Herramientas de la Cuenta',
//Added for 4GA
'Subject'=>'Referencia',
'Quote Name'=>'Referencia de la Cotización',
'Vendor Name'=>'Nombre del Proveedor',
'Requisition No'=>'Referencia del pedido',
'Tracking Number'=>'Nº de seguimiento',
'Contact Name'=>'Persona de Contacto',
'Due Date'=>'Fecha de vencimiento',
'Carrier'=>'Transportista',
'Type'=>'Tipo',
'Sales Tax'=>'Impuesto de Ventas',
'Sales Commission'=>'Comisión sobre Ventas',
'Excise Duty'=>'Impuestos Exentos',
'Total'=>'Total',
'Product Name'=>'Nombre del Producto',
'Assigned To'=>'Asignado a',
'Billing Address'=>'Dirección (Factura)',
'Shipping Address'=>'Dirección (Envío)',
'Billing City'=>'Deleg./Mpio. (Factura)',
'Billing State'=>'Estado (Factura)',
'Billing Code'=>'Código Postal (Factura)',
'Billing Country'=>'País (Factura)',
'Billing Po Box'=>'Colonia (Factura)',
'Shipping Po Box'=>'Colonia (Envío)',
'Shipping City'=>'Deleg./Mpio. (Envío)',
'Shipping State'=>'Estado (Envío)',
'Shipping Code'=>'Código Postal (Envío)',
'Shipping Country'=>'País (Envío)',
'City'=>'Deleg./Mpio.',
'State'=>'Estado',
'Code'=>'Código Postal',
'Country'=>'País',
'Created Time'=>'Creado',
'Modified Time'=>'Modificado',
'Description'=>'Descripción',
'Potential Name'=>'Oportunidad',
'Customer No'=>'Código del Cliente',
'Purchase Order'=>'Orden de Compra',
'Vendor Terms'=>'Términos del Proveedor',
'Pending'=>'Pendiente',
'Account Name'=>'Nombre de Cuenta',
'Terms & Conditions'=>'Condiciones Generales',
//Quote Info
'LBL_SO_INFORMATION'=>'Información del Pedido',
'LBL_SO'=>'Pedido:',

 //Added for 5.0 GA
'LBL_SO_FORM_TITLE'=>'Ventas',
'LBL_SUBJECT_TITLE'=>'Referencia',
'LBL_VENDOR_NAME_TITLE'=>'Nombre del Proveedor',
'LBL_TRACKING_NO_TITLE'=>'Nº de seguimiento:',
'LBL_SO_SEARCH_TITLE'=>'Buscar Pedido',
'LBL_QUOTE_NAME_TITLE'=>'Referencia de la Cotización',
'Order No'=>'Referencia de la Orden de Venta',//Order Id
'LBL_MY_TOP_SO'=>'Mis Pedidos Pendientes',
'Status'=>'Estado',
'SalesOrder'=>'Pedidos',

//Added for existing Picklist Entries

'FedEx'=>'FedEx',
'UPS'=>'UPS',
'USPS'=>'Seur',
'DHL'=>'DHL',
'BlueDart'=>'Correos',

'Created'=>'Creado',
'Approved'=>'Aprobado',
'Delivered'=>'Enviado',
'Cancelled'=>'Cancelado',
'Adjustment'=>'Ajustes',
'Sub Total'=>'Sub Total',
'AutoCreated'=>'Automática',
'Sent'=>'Enviada',
'Credit Invoice'=>'a Crédito',
'Paid'=>'Pagada',

//Added for Reports (5.0.4)
'Tax Type'=>'Impuesto',
'Discount Percent'=>'Descuento %',
'Discount Amount'=>'Descuento Importe',
'Terms & Conditions'=>'Condiciones Generales',
'S&H Amount'=>'Importe Envío y Manipulado',

//Added after 5.0.4 GA
'SalesOrder No'=>'No Pedido',

'Recurring Invoice Information' => 'Información Facturación Recurrente',
'RecurringInvoice' => 'Facturación Recurrente',
'Enable Recurring' => 'Habilitar facturación recurrente',
'Frequency' => 'Frecuencia',
'--None--'=>'--Ninguna--',
'Daily'=>'Diario',
'Weekly'=>'Semanal',
'Monthly'=>'Mensual',
'Quarterly'=>'Trimestral',
'Yearly'=>'Anual',
'half-year'=>'Semestral',
'2years' => '2 Años',
'3years' => '3 Años',
'4years' => '4 Años',
'5years' => '5 Años',
'Start Period' => 'Inicio Periodo',
'End Period' => 'Final Periodo',
'Payment Duration' => 'Duración',
'Invoice Status' => 'Estado Factura',
'Net 30 days' => '30 días',
'Net 45 days' => '45 días',
'Net 60 days' => '60 días',

'SalesOrder ID' => 'Id Orden de Venta',
);

?>
