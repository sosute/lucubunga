<?php

$birth_day           = (int)$birth_day;
$birth_month         = (int)$birth_month;
$passport_from_day   = (int)$passport_from_day;
$passport_from_month = (int)$passport_from_month;
$passport_to_day     = (int)$passport_to_day;
$passport_to_month   = (int)$passport_to_month;

$id_alias          = ($has_alias === 'Yes') ? '1' : '2';
$show_alias        = ($has_alias === 'Yes') ? "showMultiField('alias', '0');" : '';
$id_other_nation   = ($has_other_nation === 'Yes') ? '1' : '2';
$show_other_nation = ($has_other_nation === 'Yes') ? "showMultiField('citizenship', '0');" : '';
$id_sex            = ($sex === 'M') ? '1' : '2';
$id_q1             = ($q1 === 'Yes') ? '1' : '2';
$id_q2             = ($q2 === 'Yes') ? '1' : '2';
$id_q3             = ($q3 === 'Yes') ? '1' : '2';
$id_q4             = ($q4 === 'Yes') ? '1' : '2';
$id_q5             = ($q5 === 'Yes') ? '1' : '2';
$id_q6             = ($q6 === 'Yes') ? '1' : '2';
$id_q7             = ($q7 === 'Yes') ? '1' : '2';
$id_q8             = ($q8 === 'Yes') ? '1' : '2';
$id_for_via        = ($for_via === 'Yes') ? '1' : '2';
$show_for_via      = ($for_via === 'Yes') ? "swapDisplay('travelInfo', 'transit2');" : '';
$id_employment_exp = ($employment_exp === 'Yes') ? '1' : '2';
$show_employment   = ($employment_exp === 'Yes') ? "swapDisplay('employmentInfo', 'applicant.employed1');" : '';

$js = <<<EOT
document.getElementById('applicant.lastName').value='${lastname}';
document.getElementById('applicant.firstName').value='${firstname}';
document.getElementById('applicant.otherNames${id_alias}').checked=true;
${show_alias}
document.getElementById('applicant.aliases0.lastName').value='${alias_lastname}';
document.getElementById('applicant.aliases0.firstName').value='${alias_firstname}';
document.getElementById('applicant.dobDay').value='${birth_day}';
document.getElementById('applicant.dobMonth').value='${birth_month}';
document.getElementById('applicant.dobYear').value='${birth_year}';
document.getElementById('applicant.sex${id_sex}').checked=true;
document.getElementById('passport.countryOfIssue').value='${country_national}';
document.getElementById('applicant.countryOfBirth').value='${country_birth}';
document.getElementById('applicant.countryOfCitizenship').value='${country_national}';
document.getElementById('applicant.placeOfBirth').value='${city_birth}';

${show_other_nation}
document.getElementById('applicant.otherCitizenshipAnswer${id_other_nation}').checked=true;
document.getElementById('applicant.otherCitizenship0.countryOfIssue').value='${country_other_nation}';
document.getElementById('applicant.otherCitizenship0.passportNumber').value='${passport_number_other_nation}';

document.getElementById('applicant.parents0.lastName').value='${parent1_lastname}';
document.getElementById('applicant.parents0.firstName').value='${parent1_firstname}';
document.getElementById('applicant.parents1.lastName').value='${parent2_lastname}';
document.getElementById('applicant.parents1.firstName').value='${parent2_firstname}';

document.getElementById('passport.passportNumber').value='${passport_number}';
document.getElementById('passport.whenIssuedDay').value='${passport_from_day}';
document.getElementById('passport.whenIssuedMonth').value='${passport_from_month}';
document.getElementById('passport.whenIssuedYear').value='${passport_from_year}';
document.getElementById('passport.expiresDay').value='${passport_to_day}';
document.getElementById('passport.expiresMonth').value='${passport_to_month}';
document.getElementById('passport.expiresYear').value='${passport_to_year}';

document.getElementById('applicant.emailAddress').value='${email}';
document.getElementById('applicant.phones0.type').value='${tel_type}';
document.getElementById('applicant.phones0.countryCode').value='81';
document.getElementById('applicant.phones0.number').value='${tel}';
document.getElementById('applicant.emergencyContact.lastName').value='${emg_lastname}';
document.getElementById('applicant.emergencyContact.firstName').value='${emg_firstname}';
document.getElementById('applicant.emergencyContact.phone.countryCode').value='${emg_country_phone_code}';
document.getElementById('applicant.emergencyContact.phone.number').value='${emg_tel}';
document.getElementById('applicant.emergencyContact.emailAddress').value='${emg_email}';

document.getElementById('applicant.homeAddress.address1').value='${billing_address1}';
document.getElementById('applicant.homeAddress.address2').value='${billing_building}';
document.getElementById('applicant.homeAddress.apartmentNumber').value='${billing_room_number}';
document.getElementById('applicant.homeAddress.city').value='${billing_city}';
document.getElementById('applicant.homeAddress.state').value='${billing_state}';
document.getElementById('applicant.homeAddress.countryCode').value='JP';

${show_for_via}
document.getElementById('transit${id_for_via}').checked=true;
document.getElementById('usContact').value='${us_contact_name}';
document.getElementById('usContact.address.address1').value='${us_contact_address_number}';
document.getElementById('usContact.address.address2').value='${us_contact_address_building}';
document.getElementById('usContact.address.apartmentNumber').value='${us_contact_address_room_number}';
document.getElementById('usContact.address.city').value='${us_contact_address_city}';
document.getElementById('usContact.address.state').value='${us_contact_address_state}';
document.getElementById('usContact.phone.number').value='${us_contact_tel}';

${show_employment}
document.getElementById('applicant.employed${id_employment_exp}').checked=true;
document.getElementById('applicant.employer.orgName').value='${employment_name}';
document.getElementById('applicant.employer.address.address1').value='${employment_address_number}';
document.getElementById('applicant.employer.address.address2').value='${employment_address_building}';
document.getElementById('applicant.employer.address.city').value='${employment_address_city}';
document.getElementById('applicant.employer.address.state').value='${employment_address_state}';
document.getElementById('applicant.employer.address.countryCode').value='JP';
document.getElementById('applicant.employer.phone.countryCode').value='81';
document.getElementById('applicant.employer.phone.number').value='${employment_tel}';
document.getElementById('applicant.employer.jobTitle').value='${employment_job_type}';

document.getElementById('questions0.answer${id_q1}').checked=true;
document.getElementById('questions1.answer${id_q2}').checked=true;
document.getElementById('questions2.answer${id_q3}').checked=true;
document.getElementById('questions3.answer${id_q4}').checked=true;
document.getElementById('questions4.answer${id_q5}').checked=true;
document.getElementById('questions5.answer${id_q6}').checked=true;
document.getElementById('questions6.answer${id_q7}').checked=true;
document.getElementById('questions7.answer${id_q8}').checked=true;
document.getElementById('acceptWaiver1').checked=true;
document.getElementById('thirdParty1').checked=true;
window.scroll(0,document.body.scrollHeight);
EOT;
$js = preg_replace('/|\n/', '', $js);

?>
<a href="javascript:(function(){<?php echo $js;?>})();">入力用 - <?php echo $lastname.' '.$firstname;?></a>
