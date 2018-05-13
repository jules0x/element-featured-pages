<?php

namespace Jules0x\Elements;

use DNADesign\ElementalList\Model\ElementList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\LiteralField;

class ElementFeaturedPages extends ElementList
{
    private static $db = [
        'Width' => 'Enum("2, 3, 4", 3)'
    ];

    private static $table_name = 'ElementFeaturedPages';

    private static $singular_name = 'featured pages block';

    private static $description = 'List of featured page elements';

    public function getCMSFields()
    {

        $fields = parent::getCMSFields();

        if (!$this->isInDB()) {
            $fields->addFieldToTab('Root.Main', LiteralField::create('SaveNotice', '<p class="message warning">Save this element before adding featured pages</p>'));
        }

        $fields->addFieldToTab('Root.Main', DropdownField::create( 'Width', 'Max No. items per row', singleton('Jules0x\Elements\ElementFeaturedPages')->dbObject('Width')->enumValues()), 'Elements');

        return $fields;
    }

    public function getType()
    {
        return 'Featured pages';
    }
}