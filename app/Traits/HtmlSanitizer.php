<?php

namespace App\Traits;

trait HtmlSanitizer
{
    /**
     * Remove all <input> fields from an HTML string.
     *
     * @param string $htmlContent
     * @return string
     */
    public function removeInputFields(string $htmlContent): string
    {
        $dom = new \DOMDocument();

        // Handle encoding and suppress HTML warnings
        libxml_use_internal_errors(true);
        $dom->loadHTML($htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        // Remove all <input> tags
        $inputs = $dom->getElementsByTagName('input');
        while ($inputs->length > 0) {
            $input = $inputs->item(0);
            $input->parentNode->removeChild($input);
        }

        return $dom->saveHTML();
    }
}
