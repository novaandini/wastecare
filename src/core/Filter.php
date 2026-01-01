<?php

class Filter {
    public function filter(array $data, array $fields, array $messages = []): array {
        $sanitization = [];
        $validation = [];

        foreach ($fields as $field => $rules) {
            if (strpos($rules, '|') !== false) {
                [$sanitizeRule, $validateRule] = array_map(
                    'trim',
                    explode('|', $rules, 2)
                );
                $sanitization[$field] = $sanitizeRule;
                $validation[$field] = $validateRule;
            } else {
                $sanitization[$field] = trim($rules);
                $validation[$field] = '';
            }
        }

        $sanitize = new Sanitization();
        $inputs = $sanitize->sanitize($data, $sanitization);

        $validate = new Validation();
        $errors = $validate->validate($inputs, $validation, $messages);

        return [$inputs, $errors];
    }
}
