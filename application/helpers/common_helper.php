<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * returns 401 header if no session found
 */
function is_logged_in()
{
    $CI =& get_instance();
    if ($CI->session->userdata('logged_in') == null)
    {
        redirect(base_url());
        die();
    }
}

function has_profile_data()
{
    if ( ! $CI->session->userdata('has_profile_data'))
    {
        redirect(base_url() . 'Employees/create');
        die();
    }
}

function not_logged_in()
{
    $CI =& get_instance();
    return $CI->session->userdata('logged_in') == null;
}

function get_user_data()
{
    $CI =& get_instance();

    $user_id = $CI->session->userdata('logged_in')['id'];

    $CI->load->model('Employees_model');
    $user = $CI->Employees_model->get('users', ['id' => $user_id], 'id, username, type');

    if (empty($user_id))
    {
        redirect(base_url().'Login/sign_out');
    }
    return (array) $user;
}

function get_user_data_avatar()
{
    $CI =& get_instance();

    $user_id = $CI->session->userdata('logged_in')['id'];
    
    $CI->load->model('Employees_model');
    $user = $CI->Employees_model->get('users', ['id' => $user_id], 'avatar');
    if ($user->avatar && file_exists('./uploads/'. $user->avatar)) 
    {
        return base_url() . './uploads/'. $user->avatar;
    }
    return get_default_avatar();
}

function get_user_type()
{
    $CI =& get_instance();
    return (int) $CI->session->userdata('logged_in')['type'];
}

function get_user_type_text()
{
    switch (get_user_type())
    {
        case -1:
            return 'Super Admin';
        case 0:
            return 'Administrator';
        default:
            return 'Employee';
    }
}

/**
 * CHECK empty post datas
 * @param array - index to avoid checking if empty
 *
 * @return boolean
 */
function has_empty_post($fields, $exclude = [])
{
    $CI =& get_instance();
    $post_keys = array_keys($_POST);
    $empty = [];
    foreach ($fields as $field) 
    {
        if ( ! in_array($field, $post_keys))
        {
            $empty[] = $field;
            // return true;
        }
    }
    foreach ($_POST as $key => $value)
    {
        if (in_array($key, $exclude)) continue;

        $value = $CI->input->post($key);
        if (in_array($key, $fields) && (trim($value) === '' || $value === NULL))
        {
            $empty[] = $key;
            // return true;
        }
    }
    // return false;
    return $empty;
}

function parse_data($input, $fields)
{
    $CI =& get_instance();
    $data = [];
    foreach ($input as $key => $value) 
    {
        if (in_array($key, $fields))
        {
            $data[$key] = $CI->input->post($key);
        }
    }
    return $data;
}

function set_key_obj(array $array, $key)
{
    if (empty($array)) return [];
    
    if (!$array || !is_array($array)) {
        die("Array required on set_key function.");
    }
    $new_array = [];

    foreach ($array as $obj)
    {
        if (!is_object($obj))
            return [];
        if (!isset($obj->{$key}))
            return [];
        $new_array[$obj->{$key}] = $obj;
    }
    return $new_array;
}

function array_column_obj($array, $index)
{
    return array_map(function ($obj) use($index) {
        return $obj->{$index};
    }, $array);
}

function json_response($status, $message = '', $data = [])
{
    $return = [
        'status'  => $status,
        'message' => $message,
        'data'    => $data
    ];
    echo json_encode($return);
    die();
}

function upload_file($allowed_types = '*')
{
    $CI =& get_instance();
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = $allowed_types;
    
    $CI->load->library('upload', $config);
    
    $field_name = "file";
    
    if ( ! $CI->upload->do_upload($field_name))
    {
        json_response(false, $CI->upload->display_errors());
    }

    return $CI->upload->data()['file_name'];
}


function set_key(array $array, $key){
    if (!$array || !is_array($array)) {
        die("Array required on set_key function.");
    }
    foreach ($array as $arr) {
        if (!is_array($arr)) {
            die("All contents must be array in order to use set_key function.");
        }
        if (!isset($arr[$key])) {
            // die("Key not found in one or more array contents.");
            die();
        }
    }
    $new_array = [];
    foreach ($array as $arr_val) {
        $new_array[$arr_val[$key]] = $arr_val;
    }
    return $new_array;
}

function dd($data = 'test', $die = TRUE)
{
    echo '<pre>';
    var_dump($data);
    if ($die)
    {
        die();
    }
}

function get_default_avatar()
{
    return base_url() . 'assets/logo.png';
}

function system_title($header = TRUE)
{
    if ($header)
    {
        return 'Employees Record Management System';
    }
    return 'Kalinga Provincial Capitol';
}

function get_all_job_status()
{
    return [
        'Job Order',
        // 'Contractual',
        'Regular'
    ];
}

function get_all_employment_status()
{
    return [
        'Active',
        'Resigned',
        'Retired'
    ];
}

function get_countries ()
{
    return [
        'Afghanistan',
        'Albania',
        'Algeria',
        'Andorra',
        'Angola',
        'Antigua and Barbuda',
        'Argentina',
        'Armenia',
        'Australia',
        'Austria',
        'Azerbaijan',
        'Bahamas',
        'Bahrain',
        'Bangladesh',
        'Barbados',
        'Belarus',
        'Belgium',
        'Belize',
        'Benin',
        'Bhutan',
        'Bolivia',
        'Bosnia and Herzegovina',
        'Botswana',
        'Brazil',
        'Brunei',
        'Bulgaria',
        'Burkina Faso',
        'Burundi',
        'Cabo Verde',
        'Cambodia',
        'Cameroon',
        'Canada',
        'Central African Republic (CAR)',
        'Chad',
        'Chile',
        'China',
        'Colombia',
        "Comoros",
        "Congo, Democratic Republic of the",
        "Congo, Republic of the",
        "Costa Rica",
        "Cote d'Ivoire",
        "Croatia",
        "Cuba",
        "Cyprus",
        "Czechia",
        "Denmark",
        "Djibouti",
        "Dominica",
        "Dominican Republic",
        "Ecuador",
        "Egypt",
        "El Salvador",
        "Equatorial Guinea",
        "Eritrea",
        "Estonia",
        "Eswatini (formerly Swaziland)",
        "Ethiopia",
        "Fiji",
        "Finland",
        "France",
        "Gabon",
        "Gambia",
        "Georgia",
        "Germany",
        "Ghana",
        "Greece",
        "Grenada",
        "Guatemala",
        "Guinea",
        "Guinea-Bissau",
        "Guyana",
        "Haiti",
        "Honduras",
        "Hungary",
        "Iceland",
        "India",
        "Indonesia",
        "Iran",
        "Iraq",
        "Ireland",
        "Israel",
        "Italy",
        "Jamaica",
        "Japan",
        "Jordan",
        "Kazakhstan",
        "Kenya",
        "Kiribati",
        "Kosovo",
        "Kuwait",
        "Kyrgyzstan",
        "Laos",
        "Latvia",
        "Lebanon",
        "Lesotho",
        "Liberia",
        "Libya",
        "Liechtenstein",
        "Lithuania",
        "Luxembourg",
        "Madagascar",
        "Malawi",
        "Malaysia",
        "Maldives",
        "Mali",
        "Malta",
        "Marshall Islands",
        "Mauritania",
        "Mauritius",
        "Mexico",
        "Micronesia",
        "Moldova",
        "Monaco",
        "Mongolia",
        "Montenegro",
        "Morocco",
        "Mozambique",
        "Myanmar (formerly Burma)",
        "Namibia",
        "Nauru",
        "Nepal",
        "Netherlands",
        "New Zealand",
        "Nicaragua",
        "Niger",
        "Nigeria",
        "North Korea",
        "North Macedonia (formerly Macedonia)",
        "Norway",
        "Oman",
        "Pakistan",
        "Palau",
        "Palestine",
        "Panama",
        "Papua New Guinea",
        "Paraguay",
        "Peru",
        "Philippines",
        "Poland",
        "Portugal",
        "Qatar",
        "Romania",
        "Russia",
        "Rwanda",
        "Saint Kitts and Nevis",
        "Saint Lucia",
        "Saint Vincent and the Grenadines",
        "Samoa",
        "San Marino",
        "Sao Tome and Principe",
        "Saudi Arabia",
        "Senegal",
        "Serbia",
        "Seychelles",
        "Sierra Leone",
        "Singapore",
        "Slovakia",
        "Slovenia",
        "Solomon Islands",
        "Somalia",
        "South Africa",
        "South Korea",
        "South Sudan",
        "Spain",
        "Sri Lanka",
        "Sudan",
        "Suriname",
        "Sweden",
        "Switzerland",
        "Syria",
        "Taiwan",
        "Tajikistan",
        "Tanzania",
        "Thailand",
        "Timor-Leste",
        "Togo",
        "Tonga",
        "Trinidad and Tobago",
        "Tunisia",
        "Turkey",
        "Turkmenistan",
        "Tuvalu",
        "Uganda",
        "Ukraine",
        "United Arab Emirates (UAE)",
        "United Kingdom (UK)",
        "United States of America (USA)",
        "Uruguay",
        "Uzbekistan",
        "Vanuatu",
        "Vatican City (Holy See)",
        "Venezuela",
        "Vietnam",
        "Yemen",
        "Zambia",
        "Zimbabwe"
    ];
}

function get_education_levels ()
{
    return [
        'Elementary',
        'Secondary',
        'Vocational/Trade Course',
        'College',
        'Graduate Studies'
    ];
}

function array_group_by_index ($array)
{
    $new_array = [];
    foreach ($array as $key => $sub_array) 
    {
        foreach ($sub_array as $index => $value)
        {
            $new_array[$index][$key] = $value;
        }
    }
    return $new_array;
}

function array_has_value ($array)
{    
    foreach ($array as $key => $value)
    {
        if ( ! empty($value))
        {
            return TRUE;
        }
    }
    return FALSE;
}

function issetor (&$data, $or = '')
{
    return isset($data) ? $data : $or;
}

function get_emp_status_class($key)
{
    $data = [
        'success',
        'danger',
        'info'
    ];
    return $data[$key];
}

function get_account_type()
{
    return [
        0 => 'Admin Account',
        1 => 'Regular Account',
        -1=> 'Super Admin'
    ];
}

function get_leave_status($status)
{
    $data = [
        0 => 'Pending',
        1 => 'Approved',
        2 => 'Rejected'
    ];

    return issetor($data[$status]);
}

function get_page_title($view)
{
    $data = [
        'general'         => 'Profile',
        'personal'        => 'Personal Information',
        'family'          => 'Family Background',
        'education'       => 'Educational Background',
        'civil_service'   => 'Civil Service Eligibility',
        'work_experience' => 'Work Experience',
        'voluntary_work'  => 'Voluntary Work or Involvement in Civic/Non-government/People/Voluntary Organization/s',
        'trainings'       => 'Learning and Development (L&D) Interventions/Training Programs Attended',
        'other_info'      => 'Other Information',
        'questions'       => '# 34-40',
        'edit_questions'  => '# 34-40',
        'references'      => 'References',
        'agreement'       => 'Agreement',
        'attendance'      => 'Attendance',
        'leaves'          => 'Leave',
        'benefits'        => 'Benefits'
    ];

    if ( ! isset($data[$view]))
    {
        // show_404();
        return '';
    }
    return $data[$view];
}

function leave_types()
{
    return [
        'Vacation',
        'Sick',
        'Maternity / Paternity',
        'Others (Specify)'
    ];
}

function leave_sub($leave_type)
{
    if ($leave_type == 'Vacation')
    {
        return [
            'To seek employment',
            'Others (Specify)' => 1
        ];
    }

    if ($leave_type == 'Others (Specify)')
    {
        return [
            'CTO',
            'SPL',
            'Solo Parent'
        ];
    }

    return [];
}

function get_name($name)
{
    $name_string = $name->first_name;

    if ($name->middle_name) 
    {
        $name_string .= ' '.substr($name->middle_name, 0, 1).'.';
    }

    if ($name->last_name)
    {
        $name_string .= ' '.$name->last_name;
    }

    if ($name->ext_name)
    {
        $name_string .= ' '.$name->ext_name;
    }
    return strtoupper($name_string);
}
?>