/**
 * backbone model definitions for Tarefas
 */

/**
 * Use emulated HTTP if the server doesn't support PUT/DELETE or application/json requests
 */
Backbone.emulateHTTP = false;
Backbone.emulateJSON = false;

var model = {};

/**
 * long polling duration in miliseconds.  (5000 = recommended, 0 = disabled)
 * warning: setting this to a low number will increase server load
 */
model.longPollDuration = 0;

/**
 * whether to refresh the collection immediately after a model is updated
 */
model.reloadCollectionOnModelUpdate = true;


/**
 * a default sort method for sorting collection items.  this will sort the collection
 * based on the orderBy and orderDesc property that was used on the last fetch call
 * to the server. 
 */
model.AbstractCollection = Backbone.Collection.extend({
	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	lastRequestParams: null,
	collectionHasChanged: true,
	
	/**
	 * fetch the collection from the server using the same options and 
	 * parameters as the previous fetch
	 */
	refetch: function() {
		this.fetch({ data: this.lastRequestParams })
	},
	
	/* uncomment to debug fetch event triggers
	fetch: function(options) {
            this.constructor.__super__.fetch.apply(this, arguments);
	},
	// */
	
	/**
	 * client-side sorting baesd on the orderBy and orderDesc parameters that
	 * were used to fetch the data from the server.  Backbone ignores the
	 * order of records coming from the server so we have to sort them ourselves
	 */
	comparator: function(a,b) {
		
		var result = 0;
		var options = this.lastRequestParams;
		
		if (options && options.orderBy) {
			
			// lcase the first letter of the property name
			var propName = options.orderBy.charAt(0).toLowerCase() + options.orderBy.slice(1);
			var aVal = a.get(propName);
			var bVal = b.get(propName);
			
			if (isNaN(aVal) || isNaN(bVal)) {
				// treat comparison as case-insensitive strings
				aVal = aVal ? aVal.toLowerCase() : '';
				bVal = bVal ? bVal.toLowerCase() : '';
			} else {
				// treat comparision as a number
				aVal = Number(aVal);
				bVal = Number(bVal);
			}
			
			if (aVal < bVal) {
				result = options.orderDesc ? 1 : -1;
			} else if (aVal > bVal) {
				result = options.orderDesc ? -1 : 1;
			}
		}
		
		return result;

	},
	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, options) {

		// the response is already decoded into object form, but it's easier to
		// compary the stringified version.  some earlier versions of backbone did
		// not include the raw response so there is some legacy support here
		var responseText = options && options.xhr ? options.xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastRequestParams = options ? options.data : undefined;
		
		// if the collection has changed then we need to force a re-sort because backbone will
		// only resort the data if a property in the model has changed
		if (this.lastResponseText && this.collectionHasChanged) this.sort({ silent:true });
		
		this.lastResponseText = responseText;
		
		var rows;

		if (response.currentPage) {
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		} else {
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * BannedIps Backbone Model
 */
model.BannedIpsModel = Backbone.Model.extend({
	urlRoot: 'api/bannedips',
	idAttribute: 'id',
	id: '',
	ipaddress: '',
	datebanned: '',
	bantype: '',
	bannotes: '',
	defaults: {
		'id': null,
		'ipaddress': '',
		'datebanned': new Date(),
		'bantype': '',
		'bannotes': ''
	}
});

/**
 * BannedIps Backbone Collection
 */
model.BannedIpsCollection = model.AbstractCollection.extend({
	url: 'api/bannedipses',
	model: model.BannedIpsModel
});

/**
 * BannedWords Backbone Model
 */
model.BannedWordsModel = Backbone.Model.extend({
	urlRoot: 'api/bannedwords',
	idAttribute: 'id',
	id: '',
	bannedterm: '',
	datebanned: '',
	bannotes: '',
	defaults: {
		'id': null,
		'bannedterm': '',
		'datebanned': new Date(),
		'bannotes': ''
	}
});

/**
 * BannedWords Backbone Collection
 */
model.BannedWordsCollection = model.AbstractCollection.extend({
	url: 'api/bannedwordses',
	model: model.BannedWordsModel
});

/**
 * Cliente Backbone Model
 */
model.ClienteModel = Backbone.Model.extend({
	urlRoot: 'api/cliente',
	idAttribute: 'codigo',
	codigo: '',
	nome: '',
	telefone: '',
	email: '',
	defaults: {
		'codigo': null,
		'nome': '',
		'telefone': '',
		'email': ''
	}
});

/**
 * Cliente Backbone Collection
 */
model.ClienteCollection = model.AbstractCollection.extend({
	url: 'api/clientes',
	model: model.ClienteModel
});

/**
 * Imoveisb Backbone Model
 */
model.ImoveisbModel = Backbone.Model.extend({
	urlRoot: 'api/imoveisb',
	idAttribute: 'id',
	id: '',
	titulo: '',
	descricao: '',
	datadisponibilidade: '',
	imagem: '',
	valor: '',
	emailcontato: '',
	telefonecontato: '',
	tipoimovelid: '',
	defaults: {
		'id': null,
		'titulo': '',
		'descricao': '',
		'datadisponibilidade': '',
		'imagem': '',
		'valor': '',
		'emailcontato': '',
		'telefonecontato': '',
		'tipoimovelid': ''
	}
});

/**
 * Imoveisb Backbone Collection
 */
model.ImoveisbCollection = model.AbstractCollection.extend({
	url: 'api/imoveisbs',
	model: model.ImoveisbModel
});

/**
 * Language Backbone Model
 */
model.LanguageModel = Backbone.Model.extend({
	urlRoot: 'api/language',
	idAttribute: 'id',
	id: '',
	languagename: '',
	islocked: '',
	isactive: '',
	flag: '',
	defaults: {
		'id': null,
		'languagename': '',
		'islocked': '',
		'isactive': '',
		'flag': ''
	}
});

/**
 * Language Backbone Collection
 */
model.LanguageCollection = model.AbstractCollection.extend({
	url: 'api/languages',
	model: model.LanguageModel
});

/**
 * LanguageContent Backbone Model
 */
model.LanguageContentModel = Backbone.Model.extend({
	urlRoot: 'api/languagecontent',
	idAttribute: 'id',
	id: '',
	languagekeyid: '',
	languageid: '',
	content: '',
	defaults: {
		'id': null,
		'languagekeyid': '',
		'languageid': '',
		'content': ''
	}
});

/**
 * LanguageContent Backbone Collection
 */
model.LanguageContentCollection = model.AbstractCollection.extend({
	url: 'api/languagecontents',
	model: model.LanguageContentModel
});

/**
 * LanguageKey Backbone Model
 */
model.LanguageKeyModel = Backbone.Model.extend({
	urlRoot: 'api/languagekey',
	idAttribute: 'id',
	id: '',
	languagekey: '',
	defaultcontent: '',
	isadminarea: '',
	defaults: {
		'id': null,
		'languagekey': '',
		'defaultcontent': '',
		'isadminarea': ''
	}
});

/**
 * LanguageKey Backbone Collection
 */
model.LanguageKeyCollection = model.AbstractCollection.extend({
	url: 'api/languagekeies',
	model: model.LanguageKeyModel
});

/**
 * Plugin Backbone Model
 */
model.PluginModel = Backbone.Model.extend({
	urlRoot: 'api/plugin',
	idAttribute: 'id',
	id: '',
	pluginName: '',
	folderName: '',
	pluginDescription: '',
	isInstalled: '',
	dateInstalled: '',
	pluginSettings: '',
	pluginEnabled: '',
	defaults: {
		'id': null,
		'pluginName': '',
		'folderName': '',
		'pluginDescription': '',
		'isInstalled': '',
		'dateInstalled': new Date(),
		'pluginSettings': '',
		'pluginEnabled': ''
	}
});

/**
 * Plugin Backbone Collection
 */
model.PluginCollection = model.AbstractCollection.extend({
	url: 'api/plugins',
	model: model.PluginModel
});

/**
 * Sessions Backbone Model
 */
model.SessionsModel = Backbone.Model.extend({
	urlRoot: 'api/sessions',
	idAttribute: 'id',
	id: '',
	data: '',
	updatedOn: '',
	defaults: {
		'id': null,
		'data': '',
		'updatedOn': ''
	}
});

/**
 * Sessions Backbone Collection
 */
model.SessionsCollection = model.AbstractCollection.extend({
	url: 'api/sessionses',
	model: model.SessionsModel
});

/**
 * Shorturl Backbone Model
 */
model.ShorturlModel = Backbone.Model.extend({
	urlRoot: 'api/shorturl',
	idAttribute: 'id',
	id: '',
	shorturl: '',
	originalurl: '',
	urldomainid: '',
	datecreated: '',
	createdip: '',
	visits: '',
	isprivate: '',
	password: '',
	expirydate: '',
	totaluses: '',
	lastaccessed: '',
	status: '',
	userid: '',
	adminnotes: '',
	shorturlfolder: '',
	defaults: {
		'id': null,
		'shorturl': '',
		'originalurl': '',
		'urldomainid': '',
		'datecreated': new Date(),
		'createdip': '',
		'visits': '',
		'isprivate': '',
		'password': '',
		'expirydate': new Date(),
		'totaluses': '',
		'lastaccessed': new Date(),
		'status': '',
		'userid': '',
		'adminnotes': '',
		'shorturlfolder': ''
	}
});

/**
 * Shorturl Backbone Collection
 */
model.ShorturlCollection = model.AbstractCollection.extend({
	url: 'api/shorturls',
	model: model.ShorturlModel
});

/**
 * ShorturlFolder Backbone Model
 */
model.ShorturlFolderModel = Backbone.Model.extend({
	urlRoot: 'api/shorturlfolder',
	idAttribute: 'id',
	id: '',
	userId: '',
	folderName: '',
	dateCreated: '',
	defaults: {
		'id': null,
		'userId': '',
		'folderName': '',
		'dateCreated': new Date()
	}
});

/**
 * ShorturlFolder Backbone Collection
 */
model.ShorturlFolderCollection = model.AbstractCollection.extend({
	url: 'api/shorturlfolders',
	model: model.ShorturlFolderModel
});

/**
 * SiteConfig Backbone Model
 */
model.SiteConfigModel = Backbone.Model.extend({
	urlRoot: 'api/siteconfig',
	idAttribute: 'id',
	id: '',
	configKey: '',
	configValue: '',
	configDescription: '',
	availablevalues: '',
	configType: '',
	configGroup: '',
	defaults: {
		'id': null,
		'configKey': '',
		'configValue': '',
		'configDescription': '',
		'availablevalues': '',
		'configType': '',
		'configGroup': ''
	}
});

/**
 * SiteConfig Backbone Collection
 */
model.SiteConfigCollection = model.AbstractCollection.extend({
	url: 'api/siteconfigs',
	model: model.SiteConfigModel
});

/**
 * Stats Backbone Model
 */
model.StatsModel = Backbone.Model.extend({
	urlRoot: 'api/stats',
	idAttribute: 'id',
	id: '',
	dt: '',
	referer: '',
	refererIsLocal: '',
	url: '',
	pageTitle: '',
	country: '',
	imgSearch: '',
	browserFamily: '',
	browserVersion: '',
	os: '',
	osVersion: '',
	ip: '',
	userAgent: '',
	baseUrl: '',
	defaults: {
		'id': null,
		'dt': new Date(),
		'referer': '',
		'refererIsLocal': '',
		'url': '',
		'pageTitle': '',
		'country': '',
		'imgSearch': '',
		'browserFamily': '',
		'browserVersion': '',
		'os': '',
		'osVersion': '',
		'ip': '',
		'userAgent': '',
		'baseUrl': ''
	}
});

/**
 * Stats Backbone Collection
 */
model.StatsCollection = model.AbstractCollection.extend({
	url: 'api/statses',
	model: model.StatsModel
});

/**
 * Tarefa Backbone Model
 */
model.TarefaModel = Backbone.Model.extend({
	urlRoot: 'api/tarefa',
	idAttribute: 'codigo',
	codigo: '',
	titulo: '',
	descricao: '',
	prioridade: '',
	defaults: {
		'codigo': null,
		'titulo': '',
		'descricao': '',
		'prioridade': ''
	}
});

/**
 * Tarefa Backbone Collection
 */
model.TarefaCollection = model.AbstractCollection.extend({
	url: 'api/tarefas',
	model: model.TarefaModel
});

/**
 * UrlDomain Backbone Model
 */
model.UrlDomainModel = Backbone.Model.extend({
	urlRoot: 'api/urldomain',
	idAttribute: 'id',
	id: '',
	domain: '',
	premiumOnly: '',
	status: '',
	dateCreated: '',
	defaults: {
		'id': null,
		'domain': '',
		'premiumOnly': '',
		'status': '',
		'dateCreated': new Date()
	}
});

/**
 * UrlDomain Backbone Collection
 */
model.UrlDomainCollection = model.AbstractCollection.extend({
	url: 'api/urldomains',
	model: model.UrlDomainModel
});

/**
 * Users Backbone Model
 */
model.UsersModel = Backbone.Model.extend({
	urlRoot: 'api/users',
	idAttribute: 'id',
	id: '',
	username: '',
	password: '',
	level: '',
	email: '',
	lastlogindate: '',
	lastloginip: '',
	status: '',
	title: '',
	firstname: '',
	lastname: '',
	datecreated: '',
	createdip: '',
	apikey: '',
	passwordresethash: '',
	defaults: {
		'id': null,
		'username': '',
		'password': '',
		'level': '',
		'email': '',
		'lastlogindate': '',
		'lastloginip': '',
		'status': '',
		'title': '',
		'firstname': '',
		'lastname': '',
		'datecreated': '',
		'createdip': '',
		'apikey': '',
		'passwordresethash': ''
	}
});

/**
 * Users Backbone Collection
 */
model.UsersCollection = model.AbstractCollection.extend({
	url: 'api/userses',
	model: model.UsersModel
});

