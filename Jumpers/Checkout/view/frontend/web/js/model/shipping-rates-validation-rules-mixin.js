define(function() {

    return function(validationRules) {
        const originalMethod = validationRules.getObservableFields.bind(validationRules);
        validationRules.getObservableFields = function() {
            const fields = originalMethod();
            const requiredFields = [
                'postcode',
                'country_id',
                'region_id',
                'region_id_input',
            ];

            requiredFields.forEach(function(field) {
                if (fields.indexOf(field) === -1) {
                    fields.push(field);
                }
            });

            return fields;
        };

        return validationRules;
    };
});
