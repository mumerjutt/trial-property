Trial_PropertySystem

Author: Umer
 
Explanation: This module will allow the user to integrate property API in magento.

# Trial Property System

Description:

Register module will be mainly used to allow the user to integrate property API in magento.

Key features:

      1. Admin can integrate API with Magento. New Property Records are added in custom table in magento.
      2. Old records are automatically updated when API Called.
      3. Admin can view, edit and delete property records in magento.

Module Installation

Download the extension and Unzip the files in a temporary directory

Upload it to your Magento installation root directory

Execute the following commands respectively:

1.  php bin/magento module:enable Trial_PropertySystem

2.  php bin/magento setup:upgrade

3.  php bin/magento setup:di:compile

Refresh the Cache under System ⇾ Cache Management

Module can also be install using composer

Run composer require trial/property-system

**Admin**

1. Navigate to **Stores ⇾ Configuration**
2. Click on **Property System** on left tab

![Configuration](https://i.ibb.co/Lv8TMNd/img1.png)

Enter API Url, API Key, API Input Per Page Size and save configuration

**API Execution**

To execute the API, there are two ways

1. Execute API using command on magento root
   
   **bin/magento trial:property**

   This will execute the API and save data in magento


2. Execute API using CRON

   Set Sync Time in Configuration for your CRON JOB. The cron will then run after particular interval
   and execute the API.

**Manage Property Data**

1. Navigate to **Trial Extension ⇾ Trial Extension**
2. Click on **Manage Properties**

    Here you can see all the property record. You can edit, view and delete the records.

![GRID](https://i.ibb.co/kxN3DSq/img22.png)

![GRID](https://i.ibb.co/DDrQrFB/img33.png)

