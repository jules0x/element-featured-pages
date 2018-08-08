<?php

namespace Jules0x\Extensions;

use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextAreaField;

class FeatureFieldsExtension extends DataExtension {

    private static $db = [
        'FeatureSummary' => 'Varchar(200)'
    ];

    private static $has_one = [
        'FeatureImage' => Image::class
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $uploadField = UploadField::create('FeatureImage', 'Feature Image');
        $uploadField->getValidator()->setAllowedExtensions(['jpg', 'jpeg', 'png']);
        $uploadField->setDescription('Minimum 1200 x 630');

        $fields->addFieldsToTab('Root.Feature', [
            LiteralField::create('Usage',
                '<h4>
                    <em>These fields are used when this page is shown in a </em>
                    <strong>FeaturedPages</strong>
                    <em> element</em>
                </h4>
                <br>'),
            TextareaField::create('FeatureSummary'),
            $uploadField
        ]);
    }

    public function onAfterWrite()
    {
        if($this->owner->FeatureImage() && $this->owner->FeatureImage()->exists()) {
            $this->owner->FeatureImage()->publishSingle();
        }
    }
}
