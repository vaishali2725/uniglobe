angular.module('crmApp').controller('AddLeadController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
        getUser();
		
		
		
		  $scope.onchange=function(c){
		   $scope.lead.countrycode=angular.copy(c);
	   }
		
		  $scope.countries = [ 
        {name: 'Algeria', code: 'DZ', mcode:'+213'},
        {name: 'Andorra', code: 'AD',mcode:'+376'},
        {name: 'Angola', code: 'AO',mcode:'+244'},
        {name: 'Argentina ', code: 'AR',mcode:'+1264'},
        {name: 'Antigua', code: 'AM',mcode:'+374'},
		{name: 'Armenia', code: 'AG',mcode:'+1268'}, 
		{name: 'Australia', code: 'AU',mcode:'+61'},
		{name: 'Austria', code: 'AT', mcode:'+43'},
        {name: 'Azerbaijan', code: 'AZ',mcode:'+994'},
        {name: 'Bahamas', code: 'BS',mcode:'+1242'},
        {name: 'Bahrain ', code: 'BH',mcode:'+973'},
        {name: 'Bangladesh', code: 'BD',mcode:'+880'},
		{name: 'Barbados', code: 'BB',mcode:'+1246'}, 
		{name: 'Belarus', code: 'BY',mcode:'+375'},
		 {name: 'Belgium', code: 'BE', mcode:'+32'},
        {name: 'Belize', code: 'BZ',mcode:'+501'},
        {name: 'Benin', code: 'BJ',mcode:'+229'},
        {name: 'Bermuda ', code: 'BM',mcode:'+1441'},
        {name: 'Bhutan', code: 'BT',mcode:'+975'},
		{name: 'Bolivia', code: 'BO',mcode:'+591'}, 
		{name: 'Bosnia Herzegovina', code: 'BA',mcode:'+387'},
		{name: 'Botswana', code: 'BW', mcode:'+267'},
        {name: 'Brazil', code: 'BR',mcode:'+55'},
        {name: 'Brunei', code: 'BN',mcode:'+673'},
        {name: 'Bulgaria ', code: 'BG',mcode:'+359'},
        {name: 'Burkina Faso', code: 'BF',mcode:'+226'},
		{name: 'Burundi', code: 'BI',mcode:'+257'}, 
		{name: 'Cambodia', code: 'KS',mcode:'+855'},
		 {name: 'Cameroon', code: 'CM', mcode:'+237'},
        {name: 'Canada', code: 'CA',mcode:'+1'},
        {name: 'Cape Verde Islands', code: 'CV',mcode:'+238'},
        {name: 'Cayman Islands ', code: 'KY',mcode:'+1345'},
        {name: 'Central African Republic ', code: 'CF',mcode:'+236'},
		{name: 'Chile', code: 'CL',mcode:'+56'}, 
		{name: 'China', code: 'CN',mcode:'+86'},
		{name: 'Colombia', code: 'CO', mcode:'+57'},
        {name: 'Comoros', code: 'KM',mcode:'+269'},
        {name: 'Congo', code: 'CG',mcode:'+242'},
        {name: 'Cook Islands ', code: 'CK',mcode:'+682'},
        {name: 'Costa Rica', code: 'CR',mcode:'+506'},
		{name: 'Croatia', code: 'HR',mcode:'+385'}, 
		{name: 'Cuba', code: 'CU',mcode:'+53'},
		
		{name: 'Cyprus North', code: 'CY', mcode:'+90392'},
        {name: 'Cyprus South', code: 'CY',mcode:'+357'},
        {name: 'Czech Republic', code: 'CZ',mcode:'+42'},
        {name: 'Denmark ', code: 'DK',mcode:'+45'},
        {name: 'Djibouti', code: 'DJ',mcode:'+253'},
		{name: 'Dominica', code: 'DM',mcode:'+1809'}, 
		{name: 'Dominican Republic', code: 'DO',mcode:'+1809'},
		{name: 'Ecuador', code: 'EC', mcode:'+593'},
        {name: 'Egypt', code: 'EG',mcode:'+20'},
        {name: 'El Salvador', code: 'SV',mcode:'+503'},
        {name: 'Equatorial Guinea', code: 'GQ',mcode:'+240'},
        {name: 'Eritrea', code: 'ER',mcode:'+291'},
		{name: 'Estonia', code: 'EE',mcode:'+372'}, 
		{name: 'Ethiopia', code: 'ET',mcode:'+251'},
		
		{name: 'Falkland Islands', code: 'FK', mcode:'+500'},
        {name: 'Faroe Islands', code: 'FO',mcode:'+298'},
        {name: 'Fiji', code: 'FJ',mcode:'+679'},
        {name: 'Finland ', code: 'FI',mcode:'+358'},
        {name: 'France', code: 'FR',mcode:'+33'},
		{name: 'French Guiana', code: 'GF',mcode:'+594'}, 
		{name: 'French Polynesia', code: 'PF',mcode:'+689'},
		{name: 'Gabon', code: 'GA', mcode:'+241'},
        {name: 'Gambia', code: 'GM',mcode:'+220'},
        {name: 'Georgia', code: 'GE',mcode:'+7880'},
        {name: 'Germany', code: 'DE',mcode:'+49'},
        {name: 'Ghana', code: 'GS',mcode:'+233'},
		{name: 'Gibraltar', code: 'GI',mcode:'+350'}, 
		{name: 'Greece', code: 'GR',mcode:'+30'},
		
		{name: 'Greenland', code: 'GL', mcode:'+299'},
        {name: 'Grenada', code: 'GD',mcode:'+1473'},
        {name: 'Guadeloupe', code: 'GP',mcode:'+590'},
        {name: 'Guam ', code: 'GU',mcode:'+671'},
        {name: 'Guatemala', code: 'GT',mcode:'+502'},
		{name: 'Guinea', code: 'GN',mcode:'+224'}, 
		{name: 'Guinea - Bissau', code: 'GW',mcode:'+245'},
		{name: 'Haiti', code: 'GY', mcode:'+592'},
        {name: 'Gambia', code: 'HT',mcode:'+509'},
        {name: 'Honduras', code: 'HN',mcode:'+504'},
        {name: 'Hong Kong', code: 'HK',mcode:'+852'},
        {name: 'Iceland', code: 'IN',mcode:'+354'},
		{name: 'India', code: 'IN',mcode:'+91'}, 
		{name: 'Indonesia', code: 'ID',mcode:'+62'},
		
		{name: 'Iran', code: 'IR', mcode:'+98'},
        {name: 'Iraq', code: 'IQ',mcode:'+964'},
        {name: 'Ireland', code: 'IE',mcode:'+353'},
        {name: 'Israel ', code: 'IL',mcode:'+972'},
        {name: 'Italy', code: 'IT',mcode:'+39'},
		{name: 'Jamaica', code: 'JM',mcode:'+1873'}, 
		{name: 'Japan', code: 'JP',mcode:'+81'},
		{name: 'Jordan', code: 'JO', mcode:'+962'},
        {name: 'Kazakhstan', code: 'KZ',mcode:'+7'},
        {name: 'Kenya', code: 'KE',mcode:'+254'},
        {name: 'Kiribati', code: 'KI',mcode:'+686'},
        {name: 'Korea North', code: 'KP',mcode:'+850'},
		{name: 'Korea South', code: 'KR',mcode:'+82'}, 
		{name: 'Kuwait', code: 'KW',mcode:'+965'},
		{name: 'Kyrgyzstan', code: 'KG',mcode:'+996'},
		{name: 'Laos', code: 'LA',mcode:'+856'}, 
		{name: 'Latvia', code: 'LV',mcode:'+371'},
		{name: 'Lesotho', code: 'LB',mcode:'+961'},
		{name: 'Liberia', code: 'LR',mcode:'+231'},
		{name: 'Libya', code: 'LY',mcode:'+218'},
		{name: 'Liechtenstein', code: 'LI',mcode:'+417'},
		{name: 'Liechtenstein', code: 'LI',mcode:'+417'},
		{name: 'Lithuania', code: 'LT',mcode:'+370'},
		{name: 'Luxembourg', code: 'LU',mcode:'+352'},
		{name: 'Macao', code: 'MO',mcode:'+853'},
		{name: 'Madagascar', code: 'MG',mcode:'+261'},
		{name: 'Malawi', code: 'MW',mcode:'+265'},
		{name: 'Malaysia', code: 'MY',mcode:'+60'},
		{name: 'Maldives', code: 'MV',mcode:'+960'},
		{name: 'Mali', code: 'ML',mcode:'+223'},
		{name: 'Malta', code: 'MT',mcode:'+356'},
		{name: 'Marshall Islands', code: 'MH',mcode:'+692'},
		{name: 'Martinique', code: 'MQ',mcode:'+596'},
		{name: 'Mauritania', code: 'MR',mcode:'+222'},
		{name: 'Mayotte', code: 'YT',mcode:'+269'},
		{name: 'Mexico', code: 'MX',mcode:'+52'},
		{name: 'Micronesia', code: 'FM',mcode:'+691'},
		{name: 'Moldova', code: 'MD',mcode:'+373'},
		{name: 'Monaco', code: 'MC',mcode:'+377'},
		{name: 'Mongolia', code: 'MN',mcode:'+976'},
		{name: 'Montserrat', code: 'MS',mcode:'+1664'},
		{name: 'Morocco', code: 'MA',mcode:'+212'},
		{name: 'Mozambique', code: 'MZ',mcode:'+258'},
		{name: 'Myanmar', code: 'MN',mcode:'+95'},
		{name: 'Namibia', code: 'NA',mcode:'+264'},
		{name: 'Nauru', code: 'NR',mcode:'+674'},
		{name: 'Nepal', code: 'NP',mcode:'+977'},
		{name: 'Netherlands', code: 'NL',mcode:'+31'},
		{name: 'New Caledonia', code: 'NC',mcode:'+687'},
		{name: 'New Zealand', code: 'NZ',mcode:'+64'},
		{name: 'Nicaragua', code: 'NI',mcode:'+505'},
		{name: 'Niger', code: 'NE',mcode:'+227'},
		{name: 'Nigeria', code: 'NG',mcode:'+234'},
		{name: 'Niue', code: 'NU',mcode:'+683'},
		{name: 'Norfolk Islands', code: 'NF',mcode:'+672'},
		{name: 'Northern Marianas', code: 'NP',mcode:'+670'},
		{name: 'Norway', code: 'NO',mcode:'+47'},
		{name: 'Oman', code: 'OM',mcode:'+968'},
		{name: 'Pakistan', code: 'Pk',mcode:'+92'},
		{name: 'Palau', code: 'PW',mcode:'+680'},
		{name: 'Palestine', code: 'PS',mcode:'+970'},
		{name: 'Panama', code: 'PA',mcode:'+507'},
		{name: 'Papua New Guinea', code: 'PG',mcode:'+675'},
		{name: 'Paraguay', code: 'PY',mcode:'+595'},
		{name: 'Philippines', code: 'PH',mcode:'+63'},
		{name: 'Poland', code: 'PL',mcode:'+48'},
		{name: 'Portugal', code: 'PT',mcode:'+351'},
		{name: 'Puerto Rico', code: 'PR',mcode:'+1787'},
		{name: 'Qatar', code: 'QA',mcode:'+974'},
		{name: 'Reunion', code: 'RE',mcode:'+262'},
		{name: 'Romania', code: 'RO',mcode:'+40'},
		{name: 'Russia', code: 'RU',mcode:'+7'},
		{name: 'Rwanda', code: 'RW',mcode:'+250'},
		{name: 'San Marino', code: 'SM',mcode:'+378'},
		{name: 'Sao Tome Principe', code: 'ST',mcode:'+239'},
		{name: 'Saudi Arabia', code: 'SA',mcode:'+966'},
		{name: 'Senegal', code: 'SN',mcode:'+221'},
		{name: 'Serbia', code: 'CS',mcode:'+381'},
		{name: 'Seychelles', code: 'SC',mcode:'+248'},
		{name: 'Sierra Leone', code: 'SL',mcode:'+232'},
		{name: 'Singapore', code: 'SG',mcode:'+65'},
		{name: 'Slovak Republic', code: 'SK',mcode:'+421'},
		{name: 'Slovenia', code: 'SI',mcode:'+386'},
		{name: 'Solomon Islands', code: 'SB',mcode:'+677'},
		{name: 'Somalia', code: 'SO',mcode:'+252'},
		{name: 'South Africa', code: 'ZA',mcode:'+27'},
		{name: 'Spain', code: 'ES',mcode:'+34'},
 {name: 'Sri Lanka', code: 'LK',mcode:'+94'},
 {name: 'St. Helena', code: 'SH',mcode:'+290'},
 {name: 'St. Kitts ', code: 'KN',mcode:'+1869'},
 {name: 'St. Lucia', code: 'SC',mcode:'+1758'},
 {name: 'Sudan', code: 'SD',mcode:'+249'},
 {name: 'Suriname', code: 'SR',mcode:'+597'},
 {name: 'Swaziland  ', code: 'SZ',mcode:'+268'},
 {name: 'Sweden', code: 'SE',mcode:'+46'},
 {name: 'Switzerland', code: 'CH',mcode:'+41'},
 {name: 'Syria', code: 'SI',mcode:'+963'},
 {name: 'Taiwan', code: 'TW',mcode:'+886'},
 {name: 'Tajikstan', code: 'TJ',mcode:'+7'},
 {name: 'Thailand', code: 'TH',mcode:'+66'},
 {name: 'Togo', code: 'TG',mcode:'+228'},
 {name: 'Tonga', code: 'TO',mcode:'+676'},
 {name: 'Trinidad &amp; Tobago', code: 'TT',mcode:'+1868'},
 {name: 'Tunisia', code: 'TN',mcode:'+216'},
 {name: 'Turkey', code: 'TR',mcode:'+90'},
 {name: 'Turkmenistan', code: 'TM',mcode:'+993'},
 {name: 'Turks &amp; Caicos Islands ', code: 'TC',mcode:'+1649'},
 {name: 'Tuvalu', code: 'TV',mcode:'+688'},
 {name: 'Uganda', code: 'UG',mcode:'+256'},
 {name: 'Ukraine', code: 'UA',mcode:'+380'},
 {name: 'United Arab Emirates', code: 'AE',mcode:'+971'},
 {name: 'United Kingdom', code: 'UK',mcode:'+44'},
 {name: 'United States America', code: 'US',mcode:'+1'},
 {name: 'Uruguay', code: 'UY',mcode:'+598'},
 {name: 'Uzbekistan', code: 'UZ',mcode:'+7'},
 {name: 'Vanuatu', code: 'VU',mcode:'+678'},
 {name: 'Vatican City', code: 'VA',mcode:'+379'},
 {name: 'Venezuela', code: 'VE',mcode:'+58'},
 {name: 'Vietnam', code: 'VN',mcode:'+84'},
 {name: 'Virgin Islands - British ', code: 'VG',mcode:'+84'},
 {name: 'Virgin Islands - US', code: 'VI',mcode:'+84'},
 {name: 'Wallis &amp; Futuna', code: 'WF',mcode:'+681'},
 {name: 'Yemen (North); Futuna', code: 'YE',mcode:'+969'},
 {name: 'Yemen (South); Futuna', code: 'YE',mcode:'+967'},
 {name: 'Zambia', code: 'ZM',mcode:'+260'},
 {name: 'Zimbabwe', code: 'ZM',mcode:'+263'},
    ];

		
		
		
		
		
		
	$scope.lead_source = function(src){
	  if(src == 'Other'){
		  $scope.other = true;
	  }else{
		  $scope.other = false;
	  }
  }	
		
		
    function getUser(){  
  $http.post("getUsers").success(function(user){
  $scope.user = user;
      });
       
  };
   
        if ($scope.leadForm.$valid) {
        $scope.addLeads = function () {
        $http.post("addLeads?leads="+JSON.stringify($scope.lead)).success(function(){
         $("#myModal").modal('show');
		  document.leadForm.reset();
		  
    });
  };
  }
   
  
   $scope.checkleadavailability=function(){
	  //console.log($scope.lead.email);
	  $http.post("Report_Controller/checkleadavailability?email="+$scope.lead.email).success(function(data){
		  if(data==1){
			  
		  }else{
			  alert('client already exist');
			  $scope.lead.email='';
		  }
		  
	  });
   }
  
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});

'use strict';
/* Directives */
angular.module('crmUserApp.directives', [])
    .directive('pwCheck', [function () {
    return {
        require: 'ngModel',
        link: function (scope, elem, attrs, ctrl) {
            var firstEmail = '#' + attrs.pwCheck;
            elem.add(firstEmail).on('keyup', function () {
                scope.$apply(function () {
                    // console.info(elem.val() === $(firstEmail).val());
                    ctrl.$setValidity('pwmatch', elem.val() != $(firstEmail).val());
                });
            });
        }
    }
}]);

