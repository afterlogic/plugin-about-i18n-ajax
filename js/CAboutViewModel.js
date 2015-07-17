function CAboutViewModel()
{
	this.count = ko.observable(0);

	this.version = ko.observable('');
	this.version.loading = ko.observable(false);
}

CAboutViewModel.prototype.TemplateName = 'Plugin_AboutTemplate';
CAboutViewModel.prototype.TabName = 'about';
CAboutViewModel.prototype.TabTitle = AfterLogicApi.i18n('PLUGIN_ABOUT/TAB_NAME');

CAboutViewModel.prototype.clickSampleButtom = function ()
{
	this.count(this.count() + 1);
};

CAboutViewModel.prototype.getAjaxData = function ()
{
	if (!this.version.loading())
	{
		this.version.loading(true);

		AfterLogicApi.sendAjaxRequest({
			'Action': 'PluginGetAjaxData'
		}, function (oData) {
			this.version.loading(false);
			if (oData && oData['Data'])
			{
				this.version(oData['Data']);
			}
		}, this);
	}
};

AfterLogicApi.addSettingsTab(CAboutViewModel);
