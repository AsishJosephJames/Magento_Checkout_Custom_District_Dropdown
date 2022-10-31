#CustomAddressDistrict

The Module is Created In Magento 2.4.2.

Plan :
1. Create district columns in both quote_address and sales_order_address tables.
2. Create directory_district table to store district and write data patch to add districts.
3. Create Customer address attribute, override layout processor to add drop-down field to checkout.
4. Populate district drop-down depending on selected state using Ajax or Knockoutjs. (Couldn't Complete within time)
5. Save district values and display them in Order view.


Steps to run the Module :

1. git clone https://github.com/AsishJosephJames/Magento_Checkout_Custom_District_Dropdown or Download the folder.

2. Place the downloaded folder in app/code. - 

3. Go to Backend Store -> Configuration -> Customers -> Customer Configuration -> Address Templates -> HTML and replace it with the the data given below.

{{depend prefix}}{{var prefix}} {{/depend}}{{var firstname}} {{depend middlename}}{{var middlename}} {{/depend}}{{var lastname}}{{depend suffix}} {{var suffix}}{{/depend}}{{depend firstname}}<br />{{/depend}}
{{depend company}}{{var company}}<br />{{/depend}}
{{if street1}}{{var street1}}<br />{{/if}}
{{depend street2}}{{var street2}}<br />{{/depend}}
{{depend street3}}{{var street3}}<br />{{/depend}}
{{depend street4}}{{var street4}}<br />{{/depend}}
{{if city}}{{var city}},  {{/if}}{{if region}}{{var region}}, {{/if}}{{if district}}{{var district}}, {{/if}}{{if postcode}}{{var postcode}}{{/if}}<br />
{{var country}}<br />
{{depend telephone}}T: <a href="tel:{{var telephone}}">{{var telephone}}</a>{{/depend}}
{{depend fax}}<br />F: {{var fax}}{{/depend}}
{{depend vat_id}}<br />VAT: {{var vat_id}}{{/depend}}

4. Now Run below commands :

    1. Run bin/magento setup:upgrade

    2. Run bin/magento setup:di:compile

    3. Run php bin/magento setup:static-content:deploy -f

    4. Give permission and flush cache.

