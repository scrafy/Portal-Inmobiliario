@extends('layouts.index')


@section('content')
<!--NEWS MODAL-->

<div class="modal fade l-new" id="new-modal">
    <div class="modal-dialog margin-auto" role="document">
        <div class="modal-content l-modal-content">
            <div class="modal-body no-padding">
                <div class="l-modal-header-new">
                    {{Html::image('img/house.jpg',null,['class'=>'img-responsive'])}}
                    <span class="glyphicon glyphicon-remove" data-dismiss="modal"></span>
                </div>
                <div class="l-body-new">
                    <p class="title">
                        Unauthorised subletting “a major problem” facing landlords and agents
                    </p>
                    <p class="new-date">
                        02.03.2017.
                    </p>
                    <p>
                        Escalating rents and a shortage of affordable property have led to a buoyant, but illegal sub-letting market, according to LetRisks, a leading specialist provider of property insurance and referencing services for landlords and agents.
                    </p>
                    <p>
                        Just last month, Oxford Council warned tenants who were illegally subletting their homes, to hand back the keys to the properties during a two month-long amnesty, or risk prosecution for fraud. This is part of a drive to crack down on tenancy fraud, the majority of which is illegal subletting. The amnesty campaign is a warning that illegal subletting is now a criminal offence punishable by a prison sentence and a fine.
                    </p>
                    <p>
                        It is estimated 3.3 million people are living as unofficial tenants – that is as many as one in every 10 rental homes. Almost half of residential lettings agencies have found multiple occupants living in a home unofficially after checking the properties under their management (according to Direct Line research last year).
                    </p>
                    <p>
                        Michael Portman, managing director of LetRisks, said: “Although the problem is more prevalent in the social housing sector, it is a risk for private landlords. When there is multiple occupancy in a property, wear and tear and damage is dramatically accelerated – a big problem for landlords and agents. Very often, the obvious damage to the property are iron burns on carpets; cigarette burns; heat damage to polished wooden furniture; scuffs, marks and dents to walls; stiletto heel imprints on wooden floors and vinyl.
                    </p>
                    <p>
                        “There can also be considerably more mould and condensation with more occupants.  Landlords can also face expensive repairs for damage and redecoration costs, to bring the property up to the standard it was at check-in.
                    </p>
                    <p>
                        “Illegal subletting falls under tenant fraud and it’s undoubtedly a growing problem. Renting a property makes landlords vulnerable to fraud. Hence it is vital that landlords and agents carry out thorough pre-letting checks.The purpose of referencing a tenant is threefold - to check the person is who they say they are; that they can afford the rent; and that they have honoured past commitments. Information collected on the tenancy application can be used to trace them, should they abscond, or leave owing money. In addition, should the applicant make false statements, this document provides evidence for eviction.
                    </p>
                    <p>
                        “It is important not to take everything at face value. Don’t believe anything that you are told or what you read in on the application. It is vital that prospective tenants provide employment references and if there is in any doubt, the applicants should be asked to provide further proof for example copies of payslips or sight of bank statements.
                    </p>
                    <p>
                        “Extra precautions, such asking for three months’ bank statements can help catch out potential fraudulent tenants. Also take the time to compare addresses shown on the application with those shown on the ID documents. Ask for previous utility and telephone (including mobile phone) bills and statements, and check if the name and address and other information matches up with the information on the application form.”
                    </p>
                    <p>
                        LetRisks has put together some tips on what evidence to look for if you are suspicious that a tenant is subletting:
                    </p>
                    <p>
                    <ul>
                        <li>
                            Remember it pays to make regular checks on the property – every three to six months is advisable.
                        </li>
                        <li>
                            The tenants will be hiding evidence of extra tenants, so look out for additional clothing and shoes; excessive rubbish for the number of registered tenants; additional bedding like sleeping bags and pillows; suitcases and rucksacks; and extra toothbrushes.
                        </li>
                        <li>
                            Before taking on a new tenant, make sure you carry out a thorough reference to ensure you know who your tenant is.
                        </li>
                    </ul>
                    </p>
                </div>
                <div class="button-rounded-red" data-dismiss="modal">
                    <span>ClOSE</span>
                </div>
            </div>
        </div>
    </div>
</div>	

<!--END NEWS MODAL-->

<!--NEWS VIEW-->

<div class="l-news">
    <div class="l-new">
        <div class="l-new-img">
            {{Html::image('img/house.jpg',null,['class'=>'img-responsive'])}}
        </div>
        <div class="l-new-body">
            <p class="title">
                Unauthorised subletting “a major problem” facing landlords and agents
            </p>
            <p class="new-date">
                02.03.2017.
            </p>
            <p>
                Escalating rents and a shortage of affordable property have led to a buoyant, but illegal sub-letting market, according to LetRisks, a leading specialist provider of property insurance and referencing services for landlords and agents.
            </p>
            <p>
                Just last month, Oxford Council warned tenants who were illegally subletting their homes, to hand back the keys to the properties during a two month-long amnesty, or risk prosecution for fraud. This is part of a drive to crack down on tenancy fraud, the majority of which is illegal subletting. The amnesty campaign is a warning that illegal subletting is now a criminal offence punishable by a prison sentence and a fine.
            </p>
            <p>
                It is estimated 3.3 million people are living as unofficial tenants – that is as many as one in every 10 rental homes. Almost half of residential lettings agencies have found multiple occupants living in a home unofficially after checking the properties under their management (according to Direct Line research last year).
            </p>
            <p>
                Michael Portman, managing director of LetRisks, said: “Although the problem is more prevalent in the social housing sector, it is a risk for private landlords. When there is multiple occupancy in a property, wear and tear and damage is dramatically accelerated – a big problem for landlords and agents. Very often, the obvious damage to the property are iron burns on carpets; cigarette burns; heat damage to polished wooden furniture; scuffs, marks and dents to walls; stiletto heel imprints on wooden floors and vinyl.
            </p>
            <p>
                “There can also be considerably more mould and condensation with more occupants.  Landlords can also face expensive repairs for damage and redecoration costs, to bring the property up to the standard it was at check-in.
            </p>
            <p>
                “Illegal subletting falls under tenant fraud and it’s undoubtedly a growing problem. Renting a property makes landlords vulnerable to fraud. Hence it is vital that landlords and agents carry out thorough pre-letting checks.The purpose of referencing a tenant is threefold - to check the person is who they say they are; that they can afford the rent; and that they have honoured past commitments. Information collected on the tenancy application can be used to trace them, should they abscond, or leave owing money. In addition, should the applicant make false statements, this document provides evidence for eviction.
            </p>
            <p>
                “It is important not to take everything at face value. Don’t believe anything that you are told or what you read in on the application. It is vital that prospective tenants provide employment references and if there is in any doubt, the applicants should be asked to provide further proof for example copies of payslips or sight of bank statements.
            </p>
            <p>
                “Extra precautions, such asking for three months’ bank statements can help catch out potential fraudulent tenants. Also take the time to compare addresses shown on the application with those shown on the ID documents. Ask for previous utility and telephone (including mobile phone) bills and statements, and check if the name and address and other information matches up with the information on the application form.”
            </p>
            <p>
                LetRisks has put together some tips on what evidence to look for if you are suspicious that a tenant is subletting:
            </p>
            <p>
            <ul>
                <li>
                    Remember it pays to make regular checks on the property – every three to six months is advisable.
                </li>
                <li>
                    The tenants will be hiding evidence of extra tenants, so look out for additional clothing and shoes; excessive rubbish for the number of registered tenants; additional bedding like sleeping bags and pillows; suitcases and rucksacks; and extra toothbrushes.
                </li>
                <li>
                    Before taking on a new tenant, make sure you carry out a thorough reference to ensure you know who your tenant is.
                </li>
            </ul>
            </p>
        </div>
        <a href="" data-toggle="modal" data-target="#new-modal">
            <div class="button-rounded-red read-more">
                <span>READ MORE</span>
            </div>
        </a>
        <div class="separator-new"></div>		
    </div>
    <div class="l-new">
        <div class="l-new-img">
            {{Html::image('img/house.jpg',null,['class'=>'img-responsive'])}}
        </div>
        <div class="l-new-body">
            <p class="title">
                Unauthorised subletting “a major problem” facing landlords and agents
            </p>
            <p class="new-date">
                02.03.2017.
            </p>
            <p>
                Escalating rents and a shortage of affordable property have led to a buoyant, but illegal sub-letting market, according to LetRisks, a leading specialist provider of property insurance and referencing services for landlords and agents.
            </p>
            <p>
                Just last month, Oxford Council warned tenants who were illegally subletting their homes, to hand back the keys to the properties during a two month-long amnesty, or risk prosecution for fraud. This is part of a drive to crack down on tenancy fraud, the majority of which is illegal subletting. The amnesty campaign is a warning that illegal subletting is now a criminal offence punishable by a prison sentence and a fine.
            </p>
            <p>
                It is estimated 3.3 million people are living as unofficial tenants – that is as many as one in every 10 rental homes. Almost half of residential lettings agencies have found multiple occupants living in a home unofficially after checking the properties under their management (according to Direct Line research last year).
            </p>
            <p>
                Michael Portman, managing director of LetRisks, said: “Although the problem is more prevalent in the social housing sector, it is a risk for private landlords. When there is multiple occupancy in a property, wear and tear and damage is dramatically accelerated – a big problem for landlords and agents. Very often, the obvious damage to the property are iron burns on carpets; cigarette burns; heat damage to polished wooden furniture; scuffs, marks and dents to walls; stiletto heel imprints on wooden floors and vinyl.
            </p>
            <p>
                “There can also be considerably more mould and condensation with more occupants.  Landlords can also face expensive repairs for damage and redecoration costs, to bring the property up to the standard it was at check-in.
            </p>
            <p>
                “Illegal subletting falls under tenant fraud and it’s undoubtedly a growing problem. Renting a property makes landlords vulnerable to fraud. Hence it is vital that landlords and agents carry out thorough pre-letting checks.The purpose of referencing a tenant is threefold - to check the person is who they say they are; that they can afford the rent; and that they have honoured past commitments. Information collected on the tenancy application can be used to trace them, should they abscond, or leave owing money. In addition, should the applicant make false statements, this document provides evidence for eviction.
            </p>
            <p>
                “It is important not to take everything at face value. Don’t believe anything that you are told or what you read in on the application. It is vital that prospective tenants provide employment references and if there is in any doubt, the applicants should be asked to provide further proof for example copies of payslips or sight of bank statements.
            </p>
            <p>
                “Extra precautions, such asking for three months’ bank statements can help catch out potential fraudulent tenants. Also take the time to compare addresses shown on the application with those shown on the ID documents. Ask for previous utility and telephone (including mobile phone) bills and statements, and check if the name and address and other information matches up with the information on the application form.”
            </p>
            <p>
                LetRisks has put together some tips on what evidence to look for if you are suspicious that a tenant is subletting:
            </p>
            <p>
            <ul>
                <li>
                    Remember it pays to make regular checks on the property – every three to six months is advisable.
                </li>
                <li>
                    The tenants will be hiding evidence of extra tenants, so look out for additional clothing and shoes; excessive rubbish for the number of registered tenants; additional bedding like sleeping bags and pillows; suitcases and rucksacks; and extra toothbrushes.
                </li>
                <li>
                    Before taking on a new tenant, make sure you carry out a thorough reference to ensure you know who your tenant is.
                </li>
            </ul>
            </p>
        </div>
        <a href="" data-toggle="modal" data-target="#new-modal">
            <div class="button-rounded-red read-more">
                <span>READ MORE</span>
            </div>
        </a>
        <div class="separator-new"></div>		
    </div>
    <div class="l-new">
        <div class="l-new-img">
            {{Html::image('img/house.jpg',null,['class'=>'img-responsive'])}}
        </div>
        <div class="l-new-body">
            <p class="title">
                Unauthorised subletting “a major problem” facing landlords and agents
            </p>
            <p class="new-date">
                02.03.2017.
            </p>
            <p>
                Escalating rents and a shortage of affordable property have led to a buoyant, but illegal sub-letting market, according to LetRisks, a leading specialist provider of property insurance and referencing services for landlords and agents.
            </p>
            <p>
                Just last month, Oxford Council warned tenants who were illegally subletting their homes, to hand back the keys to the properties during a two month-long amnesty, or risk prosecution for fraud. This is part of a drive to crack down on tenancy fraud, the majority of which is illegal subletting. The amnesty campaign is a warning that illegal subletting is now a criminal offence punishable by a prison sentence and a fine.
            </p>
            <p>
                It is estimated 3.3 million people are living as unofficial tenants – that is as many as one in every 10 rental homes. Almost half of residential lettings agencies have found multiple occupants living in a home unofficially after checking the properties under their management (according to Direct Line research last year).
            </p>
            <p>
                Michael Portman, managing director of LetRisks, said: “Although the problem is more prevalent in the social housing sector, it is a risk for private landlords. When there is multiple occupancy in a property, wear and tear and damage is dramatically accelerated – a big problem for landlords and agents. Very often, the obvious damage to the property are iron burns on carpets; cigarette burns; heat damage to polished wooden furniture; scuffs, marks and dents to walls; stiletto heel imprints on wooden floors and vinyl.
            </p>
            <p>
                “There can also be considerably more mould and condensation with more occupants.  Landlords can also face expensive repairs for damage and redecoration costs, to bring the property up to the standard it was at check-in.
            </p>
            <p>
                “Illegal subletting falls under tenant fraud and it’s undoubtedly a growing problem. Renting a property makes landlords vulnerable to fraud. Hence it is vital that landlords and agents carry out thorough pre-letting checks.The purpose of referencing a tenant is threefold - to check the person is who they say they are; that they can afford the rent; and that they have honoured past commitments. Information collected on the tenancy application can be used to trace them, should they abscond, or leave owing money. In addition, should the applicant make false statements, this document provides evidence for eviction.
            </p>
            <p>
                “It is important not to take everything at face value. Don’t believe anything that you are told or what you read in on the application. It is vital that prospective tenants provide employment references and if there is in any doubt, the applicants should be asked to provide further proof for example copies of payslips or sight of bank statements.
            </p>
            <p>
                “Extra precautions, such asking for three months’ bank statements can help catch out potential fraudulent tenants. Also take the time to compare addresses shown on the application with those shown on the ID documents. Ask for previous utility and telephone (including mobile phone) bills and statements, and check if the name and address and other information matches up with the information on the application form.”
            </p>
            <p>
                LetRisks has put together some tips on what evidence to look for if you are suspicious that a tenant is subletting:
            </p>
            <p>
            <ul>
                <li>
                    Remember it pays to make regular checks on the property – every three to six months is advisable.
                </li>
                <li>
                    The tenants will be hiding evidence of extra tenants, so look out for additional clothing and shoes; excessive rubbish for the number of registered tenants; additional bedding like sleeping bags and pillows; suitcases and rucksacks; and extra toothbrushes.
                </li>
                <li>
                    Before taking on a new tenant, make sure you carry out a thorough reference to ensure you know who your tenant is.
                </li>
            </ul>
            </p>
        </div>
        <a href="" data-toggle="modal" data-target="#new-modal">
            <div class="button-rounded-red read-more">
                <span>READ MORE</span>
            </div>
        </a>
        <div class="separator-new"></div>		
    </div>
    <div class="l-new">
        <div class="l-new-img">
            {{Html::image('img/house.jpg',null,['class'=>'img-responsive'])}}
        </div>
        <div class="l-new-body">
            <p class="title">
                Unauthorised subletting “a major problem” facing landlords and agents
            </p>
            <p class="new-date">
                02.03.2017.
            </p>
            <p>
                Escalating rents and a shortage of affordable property have led to a buoyant, but illegal sub-letting market, according to LetRisks, a leading specialist provider of property insurance and referencing services for landlords and agents.
            </p>
            <p>
                Just last month, Oxford Council warned tenants who were illegally subletting their homes, to hand back the keys to the properties during a two month-long amnesty, or risk prosecution for fraud. This is part of a drive to crack down on tenancy fraud, the majority of which is illegal subletting. The amnesty campaign is a warning that illegal subletting is now a criminal offence punishable by a prison sentence and a fine.
            </p>
            <p>
                It is estimated 3.3 million people are living as unofficial tenants – that is as many as one in every 10 rental homes. Almost half of residential lettings agencies have found multiple occupants living in a home unofficially after checking the properties under their management (according to Direct Line research last year).
            </p>
            <p>
                Michael Portman, managing director of LetRisks, said: “Although the problem is more prevalent in the social housing sector, it is a risk for private landlords. When there is multiple occupancy in a property, wear and tear and damage is dramatically accelerated – a big problem for landlords and agents. Very often, the obvious damage to the property are iron burns on carpets; cigarette burns; heat damage to polished wooden furniture; scuffs, marks and dents to walls; stiletto heel imprints on wooden floors and vinyl.
            </p>
            <p>
                “There can also be considerably more mould and condensation with more occupants.  Landlords can also face expensive repairs for damage and redecoration costs, to bring the property up to the standard it was at check-in.
            </p>
            <p>
                “Illegal subletting falls under tenant fraud and it’s undoubtedly a growing problem. Renting a property makes landlords vulnerable to fraud. Hence it is vital that landlords and agents carry out thorough pre-letting checks.The purpose of referencing a tenant is threefold - to check the person is who they say they are; that they can afford the rent; and that they have honoured past commitments. Information collected on the tenancy application can be used to trace them, should they abscond, or leave owing money. In addition, should the applicant make false statements, this document provides evidence for eviction.
            </p>
            <p>
                “It is important not to take everything at face value. Don’t believe anything that you are told or what you read in on the application. It is vital that prospective tenants provide employment references and if there is in any doubt, the applicants should be asked to provide further proof for example copies of payslips or sight of bank statements.
            </p>
            <p>
                “Extra precautions, such asking for three months’ bank statements can help catch out potential fraudulent tenants. Also take the time to compare addresses shown on the application with those shown on the ID documents. Ask for previous utility and telephone (including mobile phone) bills and statements, and check if the name and address and other information matches up with the information on the application form.”
            </p>
            <p>
                LetRisks has put together some tips on what evidence to look for if you are suspicious that a tenant is subletting:
            </p>
            <p>
            <ul>
                <li>
                    Remember it pays to make regular checks on the property – every three to six months is advisable.
                </li>
                <li>
                    The tenants will be hiding evidence of extra tenants, so look out for additional clothing and shoes; excessive rubbish for the number of registered tenants; additional bedding like sleeping bags and pillows; suitcases and rucksacks; and extra toothbrushes.
                </li>
                <li>
                    Before taking on a new tenant, make sure you carry out a thorough reference to ensure you know who your tenant is.
                </li>
            </ul>
            </p>
        </div>
        <a href="" data-toggle="modal" data-target="#new-modal">
            <div class="button-rounded-red read-more">
                <span>READ MORE</span>
            </div>
        </a>
        <div class="separator-new"></div>		
    </div>
    <div class="l-new">
        <div class="l-new-img">
            {{Html::image('img/house.jpg',null,['class'=>'img-responsive'])}}
        </div>
        <div class="l-new-body">
            <p class="title">
                Unauthorised subletting “a major problem” facing landlords and agents
            </p>
            <p class="new-date">
                02.03.2017.
            </p>
            <p>
                Escalating rents and a shortage of affordable property have led to a buoyant, but illegal sub-letting market, according to LetRisks, a leading specialist provider of property insurance and referencing services for landlords and agents.
            </p>
            <p>
                Just last month, Oxford Council warned tenants who were illegally subletting their homes, to hand back the keys to the properties during a two month-long amnesty, or risk prosecution for fraud. This is part of a drive to crack down on tenancy fraud, the majority of which is illegal subletting. The amnesty campaign is a warning that illegal subletting is now a criminal offence punishable by a prison sentence and a fine.
            </p>
            <p>
                It is estimated 3.3 million people are living as unofficial tenants – that is as many as one in every 10 rental homes. Almost half of residential lettings agencies have found multiple occupants living in a home unofficially after checking the properties under their management (according to Direct Line research last year).
            </p>
            <p>
                Michael Portman, managing director of LetRisks, said: “Although the problem is more prevalent in the social housing sector, it is a risk for private landlords. When there is multiple occupancy in a property, wear and tear and damage is dramatically accelerated – a big problem for landlords and agents. Very often, the obvious damage to the property are iron burns on carpets; cigarette burns; heat damage to polished wooden furniture; scuffs, marks and dents to walls; stiletto heel imprints on wooden floors and vinyl.
            </p>
            <p>
                “There can also be considerably more mould and condensation with more occupants.  Landlords can also face expensive repairs for damage and redecoration costs, to bring the property up to the standard it was at check-in.
            </p>
            <p>
                “Illegal subletting falls under tenant fraud and it’s undoubtedly a growing problem. Renting a property makes landlords vulnerable to fraud. Hence it is vital that landlords and agents carry out thorough pre-letting checks.The purpose of referencing a tenant is threefold - to check the person is who they say they are; that they can afford the rent; and that they have honoured past commitments. Information collected on the tenancy application can be used to trace them, should they abscond, or leave owing money. In addition, should the applicant make false statements, this document provides evidence for eviction.
            </p>
            <p>
                “It is important not to take everything at face value. Don’t believe anything that you are told or what you read in on the application. It is vital that prospective tenants provide employment references and if there is in any doubt, the applicants should be asked to provide further proof for example copies of payslips or sight of bank statements.
            </p>
            <p>
                “Extra precautions, such asking for three months’ bank statements can help catch out potential fraudulent tenants. Also take the time to compare addresses shown on the application with those shown on the ID documents. Ask for previous utility and telephone (including mobile phone) bills and statements, and check if the name and address and other information matches up with the information on the application form.”
            </p>
            <p>
                LetRisks has put together some tips on what evidence to look for if you are suspicious that a tenant is subletting:
            </p>
            <p>
            <ul>
                <li>
                    Remember it pays to make regular checks on the property – every three to six months is advisable.
                </li>
                <li>
                    The tenants will be hiding evidence of extra tenants, so look out for additional clothing and shoes; excessive rubbish for the number of registered tenants; additional bedding like sleeping bags and pillows; suitcases and rucksacks; and extra toothbrushes.
                </li>
                <li>
                    Before taking on a new tenant, make sure you carry out a thorough reference to ensure you know who your tenant is.
                </li>
            </ul>
            </p>
        </div>
        <a href="" data-toggle="modal" data-target="#new-modal">
            <div class="button-rounded-red read-more">
                <span>READ MORE</span>
            </div>
        </a>
        <div class="separator-new"></div>		
    </div>
    <div class="l-new">
        <div class="l-new-img">
            {{Html::image('img/house.jpg',null,['class'=>'img-responsive'])}}
        </div>
        <div class="l-new-body">
            <p class="title">
                Unauthorised subletting “a major problem” facing landlords and agents
            </p>
            <p class="new-date">
                02.03.2017.
            </p>
            <p>
                Escalating rents and a shortage of affordable property have led to a buoyant, but illegal sub-letting market, according to LetRisks, a leading specialist provider of property insurance and referencing services for landlords and agents.
            </p>
            <p>
                Just last month, Oxford Council warned tenants who were illegally subletting their homes, to hand back the keys to the properties during a two month-long amnesty, or risk prosecution for fraud. This is part of a drive to crack down on tenancy fraud, the majority of which is illegal subletting. The amnesty campaign is a warning that illegal subletting is now a criminal offence punishable by a prison sentence and a fine.
            </p>
            <p>
                It is estimated 3.3 million people are living as unofficial tenants – that is as many as one in every 10 rental homes. Almost half of residential lettings agencies have found multiple occupants living in a home unofficially after checking the properties under their management (according to Direct Line research last year).
            </p>
            <p>
                Michael Portman, managing director of LetRisks, said: “Although the problem is more prevalent in the social housing sector, it is a risk for private landlords. When there is multiple occupancy in a property, wear and tear and damage is dramatically accelerated – a big problem for landlords and agents. Very often, the obvious damage to the property are iron burns on carpets; cigarette burns; heat damage to polished wooden furniture; scuffs, marks and dents to walls; stiletto heel imprints on wooden floors and vinyl.
            </p>
            <p>
                “There can also be considerably more mould and condensation with more occupants.  Landlords can also face expensive repairs for damage and redecoration costs, to bring the property up to the standard it was at check-in.
            </p>
            <p>
                “Illegal subletting falls under tenant fraud and it’s undoubtedly a growing problem. Renting a property makes landlords vulnerable to fraud. Hence it is vital that landlords and agents carry out thorough pre-letting checks.The purpose of referencing a tenant is threefold - to check the person is who they say they are; that they can afford the rent; and that they have honoured past commitments. Information collected on the tenancy application can be used to trace them, should they abscond, or leave owing money. In addition, should the applicant make false statements, this document provides evidence for eviction.
            </p>
            <p>
                “It is important not to take everything at face value. Don’t believe anything that you are told or what you read in on the application. It is vital that prospective tenants provide employment references and if there is in any doubt, the applicants should be asked to provide further proof for example copies of payslips or sight of bank statements.
            </p>
            <p>
                “Extra precautions, such asking for three months’ bank statements can help catch out potential fraudulent tenants. Also take the time to compare addresses shown on the application with those shown on the ID documents. Ask for previous utility and telephone (including mobile phone) bills and statements, and check if the name and address and other information matches up with the information on the application form.”
            </p>
            <p>
                LetRisks has put together some tips on what evidence to look for if you are suspicious that a tenant is subletting:
            </p>
            <p>
            <ul>
                <li>
                    Remember it pays to make regular checks on the property – every three to six months is advisable.
                </li>
                <li>
                    The tenants will be hiding evidence of extra tenants, so look out for additional clothing and shoes; excessive rubbish for the number of registered tenants; additional bedding like sleeping bags and pillows; suitcases and rucksacks; and extra toothbrushes.
                </li>
                <li>
                    Before taking on a new tenant, make sure you carry out a thorough reference to ensure you know who your tenant is.
                </li>
            </ul>
            </p>
        </div>
        <a href="" data-toggle="modal" data-target="#new-modal">
            <div class="button-rounded-red read-more">
                <span>READ MORE</span>
            </div>
        </a>
        <div class="separator-new"></div>		
    </div>


</div>			
<div class="l-pagination">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>		
</div>

<!--END NEWS VIEW-->



@endsection