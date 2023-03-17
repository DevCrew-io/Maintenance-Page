# Maintenance Page For Magento 2

[Maintenance Page For Magento 2]() helps to notify customers that the site is currently under maintenance or upgradation mode. Thanks to Maintenance Page extension, store visitors are well informed about maintenance progress as well as the launch date with comfort.

## Key Features

 - Enable/Disable maintenance page whenever needed.
 - Add background image for page.
 - Add description for the customer to be shown on page.
 - Add timer to show countdown for re-launch time of site.
 - White list IPs for which maintenance page should not shown.
 - Can able to Show Facebook, LinkedIn or YouTube links as well.

## How to install

You can purchase this extension via Magento market place by simply adding this product to cart and placing the order as it is free. Or you can manually install this using following steps:

```
1.  Put code from main branch under app/code/Devcrew/MaintenancePage directory.
2.  php bin/magento Module:enable Devcrew_MaintenancePage
3.  php bin/magento setup:upgrade  
4.  php bin/magento setup:di:compile
```

## How to Configure

From the Admin Panel, navigate to `Stores > Settings > Configuration`, at the **Devcrew** tab select **Maintenance Page**

![config-1](https://i.imgur.com/88IzRas.png)

### General Configuration

In **General Configuration** section there are all configurations available.

![config-2](https://i.imgur.com/Yp39iEp.png)

- **Enable Maintenance Page**: Select **Yes** to use the module's feature
- **Background Image**:
    - You can select the image to set on the background of maintenance page.
    - Admin can delete the existing (if already uploaded and saved) image by checking the "Delete Image" checkbox.
- **Whitelist IP(s)**:
  - Only IP addresses filled in this section can access the page without being redirected to **Maintenance Page**
  - It is possible to allow 1 IP address, multiple IP addresses but those must be separated by commas.
  - Admin can allow IP addresses as follows:
      - `10.0.0.10`, `10.0.0.22`, `123.0.0.1`
- **Description**:
  - Admin can add any text note needed to shown on maintenance page 
  - Admin can add text also with the help of text editor.
- **Add Timer**:
    - Used to show count down timer on maintenance page.
    - Time is calculated from the current time to the **Expected Up Date/Time**
- **Add Social Icon**
    - Used to show social icons (Facebook, LinkedIn & YouTube) icons on maintenance page.
    - If admin add the links in Facebook, LinkedIn & YouTube fields then icons will be shown else not.

## What's New

- Allowed extension to work on any theme’s front-end regardless of any
  customizations done in the theme.

## Preview on Front End 

After enabling & setting up all configurations, the maintenance page will looks like:

![preview](https://i.imgur.com/OgRGCuJ.png)

## Feature Request and Bug Report
If you want to include any feature or found any bugs, you can contact us at below email address.

``hello@devcrew.io``
