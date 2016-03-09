MailStorageBundle
=================

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d1034f39-d780-426c-b64c-67c1c1a1e0bb/big.png)](https://insight.sensiolabs.com/projects/d1034f39-d780-426c-b64c-67c1c1a1e0bb)

Bundle to store your sent mail

##  Installation:

### Step 1 : composer

```
composer require nuxia/mail-storage-bundle: "dev-master"
```

### Step 2 : MailEntry entity

```yml
# MailEntry.orm.yml
MyApp\Entity\MailEntry:
    type: "entity"
    table: "your__mail_storage_table"
    id:
        id:
            type: "string"
            length: "32"
            generator:
                strategy: "NONE"
    indexes:
        mle_id_i:
            columns: "id"
        mle_object_i:
            columns: "object"
        mle_object_id_i:
            columns: "object_id"
        mle_reference_i:
            columns: "reference"
        mle_language_i:
            columns: "language"
        mle_subject_i:
            columns: "subject"
        mle_status_i:
            columns: "status"
        mle_created_att_i:
            columns: "created_at"
        mle_sent_at_i:
            columns: "sent_at"
```

```php
<?php

//MyApp\Entity\MailEntry.php
class MailEntry extends \Nuxia\MailStorageBundle\Entity\AbstractMailEntry {
    //Some application logic
}
```

Override the container parameter nuxia.mail_storage.mail_entry.class using à compiler pass or a service file.

```yml
# myapp/service.yml
parameters:
    nuxia.mail_storage.mail_entry.class: MyApp\Entity\MailEntry

