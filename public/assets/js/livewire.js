document.addEventListener('livewire:load', function () {
    Livewire.on('municipalitiesUpdated', function (municipalities) {
        updateSelectOptions('#municipality-select', municipalities);
    });

    Livewire.on('barangaysUpdated', function (barangays) {
        updateSelectOptions('#barangay-select', barangays);
    });

    Livewire.on('municipalitiesOfBirthUpdated', function (municipalitiesOfBirth) {
        updateSelectOptions('#municipality-select-birth', municipalitiesOfBirth);
    });

    Livewire.on('barangaysOfBirthUpdated', function (barangaysOfBirth) {
        updateSelectOptions('#barangay-select-birth', barangaysOfBirth);
    });

    function updateSelectOptions(selectId, options) {
        const selectElement = $(selectId);
        selectElement.empty();
        selectElement.append('<option value="">Select A Municipality</option>');

        options.forEach(function (option) {
            selectElement.append('<option value="' + option.id + '">' + option.municipality + '</option>');
        });
    }
});
