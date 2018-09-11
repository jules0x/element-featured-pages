<?php

namespace Jules0x\Elements\Model;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;

class FeaturedPage extends BaseElement {

    private static $icon = 'font-icon-circle-star';

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
            'FeaturedPageID',   //Remove to reorder
            'Settings',         //Disable options
            'TitleAndDisplayed' //Disable option
        ]);

        $fields->addFieldsToTab('Root.Main', [
            TreeDropdownField::create('FeaturedPageID', 'Page', SiteTree::class)
        ]);

        return $fields;
    }

    /**
     * Get Title of target page
     * @return string
     */
    public function getTitle() {
        if ($this->FeaturedPageID > 0) {
            return $this->FeaturedPage()->Title;
        }
    }

    public function getType()
    {
        return $this->config()->get('singular_name');
    }

    /**
     * Prevent nested containers on ElementList Elements
     * @return bool
     */
    public function getHideElementHolder()
    {
        return true;
    }
}
