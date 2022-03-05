<?php


namespace App\Traits;


trait ValidateAuthorsTrait
{
    protected function authors()
    {
        if (!isset($this->authors) || !is_array($this->authors))
            return false;

        $data = collect($this->authors);

        $authorsValidation = collect();

        foreach ($this->authors as $key => $author) {

            $authorsValidation->put('authors.' . $key . '.author_name', 'required');
        }

        $this->merge(['authors' => $data->toArray()]);
        $this->mergeRules($authorsValidation->toArray());
    }

}
