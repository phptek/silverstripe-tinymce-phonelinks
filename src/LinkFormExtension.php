<?php

namespace ZarockNZ\TinymcePhoneLinks;

use SilverStripe\ORM\DataExtension;
use SilverStripe\View\Requirements;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\Form;

/**
 * Class LinkFormExtension
 *
 * Modifies the HTML Editor Link Form to allow custom link types.
 */
class LinkFormExtension extends DataExtension
{

    /**
     * Extends the link form.
     *
     * @param  Form   $form
     * @return Form
     */
    public function updateLinkForm(Form $form) : Form
    {
        Requirements::javascript('client/js/linkform.js');

        $fields = $form->Fields();
        $linkType = $fields->dataFieldByName('LinkType');
        $types = $linkType->getSource();

        // Add telephone number type.
        $types['tel'] = _t('EditorExtensions.TELNUMBER', 'Telephone number');

        $linkType->setSource($types);
        $fields->insertAfter(
            TextField::create('tel', _t('EditorExtensions.TELNUMBER', 'Telephone number')),
            'file'
        );

        return $form;
    }

}
