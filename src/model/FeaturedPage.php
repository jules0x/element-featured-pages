<?php

namespace Jules0x\Elements\Model;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\TreeDropdownField;

class FeaturedPage extends BaseElement {

    private static $table_name = 'FeaturedPage';

    private static $singular_name = 'Featured page';

    private static $plural_name = 'Featured pages';

    private static $has_one = [
        'FeaturedPage' => SiteTree::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'BackgroundColor',
            'Constrain',
            'Settings'
        ]);

        $fields->addFieldToTab('Root.Main', TreeDropdownField::create('FeaturedPageID', 'Page', SiteTree::class));

        return $fields;
    }

    public function getTitle() {
        if ($this->FeaturedPageID > 0) {
            return $this->FeaturedPage()->Title;
        }
    }

    public function getType()
    {
        return $this->config()->get('singular_name');
    }

    public function getHideElementHolder()
    {
        return true;
    }
}
