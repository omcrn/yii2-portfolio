<?php
/**
 * User: zura
 * Date: 2/17/17
 * Time: 10:22 AM
 */

namespace omcrn\portfolio;

use yii\db\ActiveRecord;


/**
 * Class TranslatableModelTrait
 *
 * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package omcrn\portfolio
 */
trait TranslatableModelTrait
{
    /**
     * Find PageTranslation object from `translations` array by locale
     *
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     * @param $locale
     * @return ActiveRecord
     */
    public function findTranslationByLocale($locale)
    {
        $translations = array_merge($this->newTranslations, $this->translations);
        foreach ($translations as $translation) {
            if ($translation->locale === $locale) {
                return $translation;
            }
        }

        return new static::$translateModel();
    }
}