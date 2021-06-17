$(function () {
    const ALL_SELECT = 0;
    const SITE_INDEX = $('#site-index');

    let groupsInfo = JSON.parse(global.groupsInfo);

    /** Объект является ViewModel для Knockout */
    function GroupsModel() {
        let self = this;

        self.groupsList = ko.observableArray([]);
        self.selectedCountry = ko.observable();
        self.selectedCity = ko.observable();

        self.init = function () {
            for (let index in groupsInfo) {
                self.groupsList.push(groupsInfo[index]);
            }
        };

        self.filterGroups = function () {
            self.groupsList.removeAll();
            for (let index in groupsInfo) {
                if (Number(self.selectedCountry()) !== ALL_SELECT &&
                    (groupsInfo[index].country === null || groupsInfo[index].country.id !== Number(self.selectedCountry()))) {
                    continue;
                }
                if (Number(self.selectedCity()) !== ALL_SELECT &&
                    (groupsInfo[index].city === null || groupsInfo[index].city.id !== Number(self.selectedCity()))) {
                    continue;
                }
                self.groupsList.push(groupsInfo[index]);
            }
        };

    }

    /** Knockout привязка модели */
    let groupsModel = new GroupsModel();
    groupsModel.init();
    ko.applyBindings(groupsModel, document.getElementById("site-index"));

    SITE_INDEX.on('change', '#countriesSelect', function () {
        groupsModel.filterGroups();
    });
    SITE_INDEX.on('change', '#citiesSelect', function () {
        groupsModel.filterGroups();
    });
})