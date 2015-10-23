<?php
// main config array 
$config = array(
	"Services"=>array(
		"configuration"=>array(
                    
                ),
                "drivers_login"=>array(
			"device_type"=>array(
				"leble"=>"device_type",
				"type"=>"text",
				"value"=>'1'
			),
			"email"=>array(
				"leble"=>"email",
				"type"=>"text",
				"value"=>''
			),
			"pass"=>array(
				"leble"=>"pass",
				"type"=>"text",
				"value"=>''
			),
			"device_unique_id"=>array(
				"leble"=>"device_unique_id",
				"type"=>"text",
				"value"=>''
			),
			"lat"=>array(
				"leble"=>"lat",
				"type"=>"text",
				"value"=>''
			),
			"lon"=>array(
				"leble"=>"lon",
				"type"=>"text",
				"value"=>''
			),
		),
		"customer_registration"=>array(
			"f_name"=>array(
				"leble"=>"f_name",
				"type"=>"text",
				"value"=>''
			),
			"l_name"=>array(
				"leble"=>"l_name",
				"type"=>"text",
				"value"=>''
			),
			"mobile"=>array(
				"leble"=>"mobile",
				"type"=>"text",
				"value"=>''
			),
			"email"=>array(
				"leble"=>"email",
				"type"=>"text",
				"value"=>''
			),
			"pass"=>array(
				"leble"=>"pass",
				"type"=>"text",
				"value"=>''
			),
			"device_type"=>array(
				"leble"=>"device_type",
				"type"=>"text",
				"value"=>''
			),
			"device_unique_id"=>array(
				"leble"=>"device_unique_id",
				"type"=>"text",
				"value"=>''
			),
			"user_image"=>array(
				"leble"=>"user_image",
				"type"=>"text",
				"value"=>''
			),
			"my_refferal_code"=>array(
				"leble"=>"refered by",
				"type"=>"text",
				"value"=>''
			),
			
		),
		"referal_registration"=>array(
			"username"=>array(
				"leble"=>"username",
				"type"=>"text",
				"value"=>''
			),
			"email"=>array(
				"leble"=>"email",
				"type"=>"text",
				"value"=>''
			),
			"pass"=>array(
				"leble"=>"pass",
				"type"=>"text",
				"value"=>''
			),
			"my_refferal_code"=>array(
				"leble"=>"refered by",
				"type"=>"text",
				"value"=>''
			),
		),
		"new_order"=>array(
			"device_type"=>array(
				"leble"=>"device_type",
				"type"=>"text",
				"value"=>'1'
			),
			"pick_up"=>array(
				"leble"=>"pick_up",
				"type"=>"text",
				"value"=>''
			),
			"pick_up_lat"=>array(
				"leble"=>"pick_up_lat",
				"type"=>"text",
				"value"=>''
			),
			"pick_up_lon"=>array(
				"leble"=>"pick_up_lon",
				"type"=>"text",
				"value"=>''
			),
			"drop_off"=>array(
				"leble"=>"drop_off",
				"type"=>"text",
				"value"=>''
			),
			"drop_off_lat"=>array(
				"leble"=>"drop_off_lat",
				"type"=>"text",
				"value"=>''
			),
			"drop_off_lon"=>array(
				"leble"=>"drop_off_lon",
				"type"=>"text",
				"value"=>''
			),
			"user_id"=>array(
				"leble"=>"user_id",
				"type"=>"text",
				"value"=>'13'
			),
			"instruction"=>array(
				"leble"=>"instruction",
				"type"=>"text",
				"value"=>''
			),
			"payment_type"=>array(
				"leble"=>"payment_type",
				"type"=>"text",
				"value"=>''
			),
			"device_unique_id"=>array(
				"leble"=>"device_unique_id",
				"type"=>"text",
				"value"=>''
			),
			"ride_type"=>array(
				"leble"=>"ride_type",
				"type"=>"text",
				"value"=>'0'
			),
			"cupon_code"=>array(
				"leble"=>"cupon_code",
				"type"=>"text",
				"value"=>'TAXCL500'
			)
		),
		"save_card_information"=>array(
			"device_type"=>array(
				"leble"=>"device_type",
				"type"=>"text",
				"value"=>'1'
			),
			"user_id"=>array(
				"leble"=>"user_id",
				"type"=>"text",
				"value"=>''
			),
                        "user_type"=>array(
                                "leble"=>"user type",
				"type"=>"text",
				"value"=>'1'
                        ),
			"cardno"=>array(
				"leble"=>"cardno",
				"type"=>"text",
				"value"=>''
			),
			"holdername"=>array(
				"leble"=>"holdername",
				"type"=>"text",
				"value"=>''
			),
			"expirydate"=>array(
				"leble"=>"expirydate",
				"type"=>"text",
				"value"=>''
			),
			"cvvno"=>array(
				"leble"=>"cvvno",
				"type"=>"text",
				"value"=>''
			),
			"cardtype"=>array(
				"leble"=>"cardtype",
				"type"=>"text",
				"value"=>''
			),
                        "address"=>array(
				"leble"=>"address",
				"type"=>"text",
				"value"=>''
			),
			"postcode"=>array(
				"leble"=>"postcode",
				"type"=>"text",
				"value"=>''
			),
                        
			"billingadd"=>array(
				"leble"=>"billingadd",
				"type"=>"text",
				"value"=>''
			),
			"billingareaname"=>array(
				"leble"=>"billingareaname",
				"type"=>"text",
				"value"=>''
			),
			"billingstreetname"=>array(
				"leble"=>"billingstreetname",
				"type"=>"text",
				"value"=>''
			),
			"billingcity"=>array(
				"leble"=>"billingcity",
				"type"=>"text",
				"value"=>''
			),
			"billingstate"=>array(
				"leble"=>"billingstate",
				"type"=>"text",
				"value"=>''
			),
			"billingpin"=>array(
				"leble"=>"billingpin",
				"type"=>"text",
				"value"=>''
			),
			"billingcountry"=>array(
				"leble"=>"billingcountry",
				"type"=>"text",
				"value"=>''
			),
		),
		"savedcards"=>array(
			"device_type"=>array(
				"leble"=>"device_type",
				"type"=>"text",
				"value"=>'1'
			),
                        "user_id"=>array(
				"leble"=>"user_id",
				"type"=>"text",
				"value"=>''
			)
		),
		"get_ride_details"=>array(
			"device_type"=>array(
				"leble"=>"device_type",
				"type"=>"text",
				"value"=>'1'
			),
                        "ride_id"=>array(
				"leble"=>"ride_id",
				"type"=>"text",
				"value"=>''
			)
		),
		"accept_ride"=>array(
			"device_type"=>array(
				"leble"=>"device_type",
				"type"=>"text",
				"value"=>'1'
			),
                        "ride_id"=>array(
				"leble"=>"ride_id",
				"type"=>"text",
				"value"=>'1'
			),
			"driver_lat"=>array(
				"leble"=>"driver_lat",
				"type"=>"text",
				"value"=>''
			),
			"driver_lon"=>array(
				"leble"=>"driver_lon",
				"type"=>"text",
				"value"=>''
			),
			"driver_id"=>array(
				"leble"=>"driver_id",
				"type"=>"text",
				"value"=>'12'
			),
			"devicetype"=>array(
				"leble"=>"devicetype",
				"type"=>"text",
				"value"=>'1'
			)
		),
		"arriving_now"=>array(
			"device_type"=>array(
				"leble"=>"devicetype",
				"type"=>"text",
				"value"=>'1'
			),
                        "ride_id"=>array(
				"leble"=>"ride_id",
				"type"=>"text",
				"value"=>'1'
			),
			"driver_lat"=>array(
				"leble"=>"driver_lat",
				"type"=>"text",
				"value"=>'1'
			),
			"driver_lon"=>array(
				"leble"=>"driver_lon",
				"type"=>"text",
				"value"=>'1'
			),
			"driver_id"=>array(
				"leble"=>"driver_id",
				"type"=>"text",
				"value"=>'170'
			)
		),
		"start_trip"=>array(
			"device_type"=>array(
				"leble"=>"devicetype",
				"type"=>"text",
				"value"=>'1'
			),
                        "driver_id"=>array(
				"leble"=>"driver_id",
				"type"=>"text",
				"value"=>'170'
			),
                        "driver_lat"=>array(
				"leble"=>"driver_lat",
				"type"=>"text",
				"value"=>'1'
			),
			"driver_lon"=>array(
				"leble"=>"driver_lon",
				"type"=>"text",
				"value"=>''
			),
			"ride_id"=>array(
				"leble"=>"ride_id",
				"type"=>"text",
				"value"=>'1'
			)
		),
		"end_trip"=>array(
			"device_type"=>array(
				"leble"=>"devicetype",
				"type"=>"text",
				"value"=>'1'
			),
                        "driver_id"=>array(
				"leble"=>"driver_id",
				"type"=>"text",
				"value"=>'170'
			),
                        "driver_lat"=>array(
				"leble"=>"driver_lat",
				"type"=>"text",
				"value"=>'1'
			),
			"driver_lon"=>array(
				"leble"=>"driver_lon",
				"type"=>"text",
				"value"=>''
			),
			"ride_id"=>array(
				"leble"=>"ride_id",
				"type"=>"text",
				"value"=>'1'
			),
			"ride_cost"=>array(
				"leble"=>"Ride Cost ",
				"type"=>"text",
				"value"=>'1'
			)
		),
		
		"get_selected_driver_details"=>array(
			"ride_id"=>array(
				"leble"=>"ride_id",
				"type"=>"text",
				"value"=>'1'
			)
		),
		"traceactiveride"=>array(
			"ride_id"=>array(
				"leble"=>"ride_id",
				"type"=>"text",
				"value"=>'1'
			)
		),
		"approved_rides"=>array(
			"user_id"=>array(
				"leble"=>"user_id",
				"type"=>"text",
				"value"=>'13'
			),
                        "page_no"=>array(
				"leble"=>"Page NO",
				"type"=>"text",
				"value"=>'1'
			),
		),
		"completed_rides"=>array(
			"user_id"=>array(
				"leble"=>"user_id",
				"type"=>"text",
				"value"=>'13'
			),
                        "page_no"=>array(
				"leble"=>"Page NO",
				"type"=>"text",
				"value"=>'1'
			),
		),
		"favorite_rides"=>array(
			"user_id"=>array(
				"leble"=>"user_id",
				"type"=>"text",
				"value"=>'13'
			),
                        "page_no"=>array(
				"leble"=>"Page NO",
				"type"=>"text",
				"value"=>'1'
			),
		),
		"retrieve_password"=>array(
			"device_type"=>array(
				"leble"=>"Device type",
				"type"=>"text",
				"value"=>'1'
			),
			"email"=>array(
				"leble"=>"Enter Email",
				"type"=>"text",
				"value"=>''
			)
		),
		"go_off_duty"=>array(
			"device_type"=>array(
				"leble"=>"Device type",
				"type"=>"text",
				"value"=>'1'
			),
			"user_id"=>array(
				"leble"=>"Enter user ID",
				"type"=>"text",
				"value"=>''
			)
		),
		"userinformation"=>array(
			"device_type"=>array(
				"leble"=>"Device type",
				"type"=>"text",
				"value"=>'1'
			),
			"user_id"=>array(
				"leble"=>"Enter user ID",
				"type"=>"text",
				"value"=>''
			)
		),
		"customerinfoservice"=>array(
			"device_type"=>array(
				"leble"=>"Device type",
				"type"=>"text",
				"value"=>'2'
			),
			"user_id"=>array(
				"leble"=>"Enter user ID",
				"type"=>"text",
				"value"=>''
			)
		),
		"customer_login"=>array(
			"device_type"=>array(
				"leble"=>"Device type",
				"type"=>"text",
				"value"=>'2'
			),
			"email"=>array(
				"leble"=>"Enter user Email Id",
				"type"=>"text",
				"value"=>''
			),
			"pass"=>array(
				"leble"=>"Enter Password",
				"type"=>"text",
				"value"=>''
			),
			"device_unique_id"=>array(
				"leble"=>"Enter device unique id",
				"type"=>"text",
				"value"=>''
			),
			"lat"=>array(
				"leble"=>"Enter latitude",
				"type"=>"text",
				"value"=>''
			),
			"lon"=>array(
				"leble"=>"Enter longitude",
				"type"=>"text",
				"value"=>''
			),
                        "ride_id"=>array(
				"leble"=>"ride Id",
				"type"=>"text",
				"value"=>''
			)
		),
		"rideTraceService"=>array(
			"device_type"=>array(
				"leble"=>"Device type",
				"type"=>"text",
				"value"=>'1'
			),
			"ride_id"=>array(
				"leble"=>"Enter Ride id",
				"type"=>"text",
				"value"=>''
			),
			"long_lat"=>array(
				"leble"=>"Enter Long and Lat",
				"type"=>"text",
				"value"=>''
			),
				"driver_id"=>array(
				"leble"=>"Enter Driver id",
				"type"=>"text",
				"value"=>''
			),
				"ridestatus"=>array(
				"leble"=>"Enter Ride status",
				"type"=>"text",
				"value"=>'0'
			),
		),
		
		"recent_trip"=>array(
			"device_type"=>array(
				"leble"=>"Device type",
				"type"=>"text",
				"value"=>'1'
			),
			"driver_id"=>array(
				"leble"=>"Enter Driver id",
				"type"=>"text",
				"value"=>''
			),
			"ride_id"=>array(
				"leble"=>"Enter ride id",
				"type"=>"text",
				"value"=>''
			),
			"page_no"=>array(
				"leble"=>"Enter page no",
				"type"=>"text",
				"value"=>'1'
			),
		),
		
		"customerTripDetails"=>array(
			"user_id"=>array(
				"leble"=>"User ID",
				"type"=>"text",
				"value"=>''
			),
			"ride_id"=>array(
				"leble"=>"Enter Ride ID",
				"type"=>"text",
				"value"=>''
			),
		),
		"googleApiService"=>array(
			"location"=>array(
				"leble"=>"Enter Location",
				"type"=>"text",
				"value"=>''
			),
		),
		"uploadpic"=>array(
			"device_type"=>array(
				"leble"=>"Enter device type",
				"type"=>"text",
				"value"=>'1'
			),
			"user_id"=>array(
				"leble"=>"Enter User id",
				"type"=>"text",
				"value"=>''
			),
			"user_type"=>array(
				"leble"=>"Enter User Type 1=driver 2= customer",
				"type"=>"text",
				"value"=>'1'
			),
			"image"=>array(
				"leble"=>"Choose pic",
				"type"=>"file",
				"value"=>''
			),
		),
		"notifycustomer"=>array(
			"device_type"=>array(
				"leble"=>"Enter device type",
				"type"=>"text",
				"value"=>'1'
			),
			"user_id"=>array(
				"leble"=>"Enter User id",
				"type"=>"text",
				"value"=>''
			),
			"customer_id"=>array(
				"leble"=>"Notify customer id",
				"type"=>"text",
				"value"=>''
			),
			"notify_type"=>array(
				"leble"=>"Notify for",
				"type"=>"text",
				"value"=>'0'
			),
		),
		"heat_map_cords"=>array(
			"device_type"=>array(
				"leble"=>"Enter device type",
				"type"=>"text",
				"value"=>'1'
			),
			"user_id"=>array(
				"leble"=>"Enter User id",
				"type"=>"text",
				"value"=>''
			),
			"lat"=>array(
				"leble"=>"Enter Lat",
				"type"=>"text",
				"value"=>''
			),
			"lon"=>array(
				"leble"=>"Enter Lat",
				"type"=>"text",
				"value"=>''
			),
		),
		"drivertraceride"=>array(
			"ride_id"=>array(
				"leble"=>"Enter Ride ID",
				"type"=>"text",
				"value"=>''
			),
			"ride_traceid"=>array(
				"leble"=>"Enter last trace id",
				"type"=>"text",
				"value"=>'0'
			)
		),
		
		"ignoreorder"=>array(
			"ride_id"=>array(
				"leble"=>"Enter ride id",
				"type"=>"text",
				"value"=>''
			),
			"driver_id"=>array(
				"leble"=>"Enter driver id",
				"type"=>"text",
				"value"=>''
			)
		),
		
		"driverss_ride_tracking"=>array(
			"ride_id"=>array(
				"leble"=>"Enter Ride ID",
				"type"=>"text",
				"value"=>''
			),
			"driver_lat"=>array(
				"leble"=>"Enter Driver Lat",
				"type"=>"text",
				"value"=>''
			),
			"driver_lon"=>array(
				"leble"=>"Enter Driver Lon",
				"type"=>"text",
				"value"=>''
			),
			"ride_status"=>array(
				"leble"=>"Enter ride Status",
				"type"=>"text",
				"value"=>''
			)
		),
		
		"rate_driver"=>array(
			"customer_id"=>array(
				"leble"=>"Enter customer ID",
				"type"=>"text",
				"value"=>''
			),
			"ride_id"=>array(
				"leble"=>"Enter Ride ID",
				"type"=>"text",
				"value"=>''
			),
			
			"rating"=>array(
				"leble"=>"Enter rating",
				"type"=>"text",
				"value"=>''
			),
			"comment"=>array(
				"leble"=>"Enter comment",
				"type"=>"text",
				"value"=>''
			)
		),
		
		
		"rate_customer"=>array(
			"driver_id"=>array(
				"leble"=>"Enter Driver ID",
				"type"=>"text",
				"value"=>''
			),
			"ride_id"=>array(
				"leble"=>"Enter Ride ID",
				"type"=>"text",
				"value"=>''
			),
			
			"rating"=>array(
				"leble"=>"Enter rating",
				"type"=>"text",
				"value"=>''
			),
			"comment"=>array(
				"leble"=>"Enter comment",
				"type"=>"text",
				"value"=>''
			),
		),
                "runtimeridecostsave"=>array(
                    "driver_id"=>array(
                            "leble"=>"Enter Driver ID",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "ride_id"=>array(
                            "leble"=>"Enter Ride ID",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "runtimecost"=>array(
                            "leble"=>"Cost",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "runtimedistance"=>array(
                            "leble"=>"Distance",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "driverregistration"=>array(
                    "txtDCity"=>array(
                            "leble"=>"User Working City :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtUname"=>array(
                            "leble"=>"UserName :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtUfname"=>array(
                            "leble"=>"First name :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtUlname"=>array(
                            "leble"=>"Last name :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtUemail"=>array(
                            "leble"=>"Email :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtUmobile"=>array(
                            "leble"=>"Mobile :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtUaddress"=>array(
                            "leble"=>"Address ",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtUpass"=>array(
                            "leble"=>"Password :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "refferal_code"=>array(
                            "leble"=>"Refferal Code :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtCcname"=>array(
                            "leble"=>"txtCcname :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtCaddress1"=>array(
                            "leble"=>"txtCaddress1 :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtCaddress2"=>array(
                            "leble"=>"txtCaddress2 :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtCcity"=>array(
                            "leble"=>"txtCcity :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtCregion"=>array(
                            "leble"=>"txtCregion :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtCpcode"=>array(
                            "leble"=>"txtCpcode :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtCmobile"=>array(
                            "leble"=>"txtCmobile :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "txtCABN"=>array(
                            "leble"=>"txtCABN :",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
		"add"=>array(
                    "txtUname"=>array(
                            "leble"=>"Name :",
                            "type"=>"text",
                            "value"=>''
                    )
                ),
                "userlogout"=>array(
                    "user_id"=>array(
                            "leble"=>"User ID :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "user_type"=>array(
                            "leble"=>"User type :",
                            "type"=>"text",
                            "value"=>''
                    ),
					"device_type"=>array(
                            "leble"=>"Device Type :",
                            "type"=>"text",
                            "value"=>'1'
                    )
                ),
                "makefavride"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type :",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "ride_id"=>array(
                            "leble"=>"Ride Id :",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "makefav"=>array(
                            "leble"=>"make Fav :",
                            "type"=>"text",
                            "value"=>'1'
                    )
                ),
                "usersridecommisions"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "page_no"=>array(
                            "leble"=>"Page NO",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                ),
                "rideinfo"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "ride_id"=>array(
                            "leble"=>"Ride Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "docummentuploads"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "user_type"=>array(
                            "leble"=>"User Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "document_type"=>array(
                            "leble"=>"document Type",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "document_expiry_date"=>array(
                            "leble"=>"document Expiry Date",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "paycommissions"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "tstduepayment"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
					"company_id"=>array(
                            "leble"=>"company_id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "rechargedaccount"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "scheme_id"=>array(
                            "leble"=>"Schem choose",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "card_id"=>array(
                            "leble"=>"Choosed Card",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "amount"=>array(
                            "leble"=>"Amount ",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "rechargeschemes"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "go_on_duty"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
					"lat"=>array(
                            "leble"=>"Lat",
                            "type"=>"text",
                            "value"=>''
                    ),
					"lon"=>array(
                            "leble"=>"Long",
                            "type"=>"text",
                            "value"=>''
                    ),
					"device_unique_id"=>array(
                            "leble"=>"device_unique_id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "getlastrideid"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "userrattingsection"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "type"=>array(
                            "leble"=>"User Type",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "makedefaulcard"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "prev_default_card_id"=>array(
                            "leble"=>"Prev Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "creditcardid"=>array(
                            "leble"=>"card id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "removecreditcard"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "creditcardid"=>array(
                            "leble"=>"card id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "schemeenter"=>array(
                    "name"=>array(
                            "leble"=>"name",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "amount"=>array(
                            "leble"=>"amount",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "point"=>array(
                            "leble"=>"point",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "decriptlinkstr"=>array(
                    "encriptedlink"=>array(
                        "leble"=>"Encripted str",
                        "type"=>"text",
                        "value"=>'' 
                    )
                ),
                "nearestdriverdetails"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "lat"=>array(
                            "leble"=>"user lat",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "lon"=>array(
                            "leble"=>"user lon",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "cancelride"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "ride_id"=>array(
                            "leble"=>"Ride Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "user_type"=>array(
                            "leble"=>"User Type",
                            "type"=>"text",
                            "value"=>'2'
                    ),
                ),
                "rejectorder"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "driver_id"=>array(
                            "leble"=>"Driver Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "ride_id"=>array(
                            "leble"=>"Ride Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "drivervehicles"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "driver_id"=>array(
                            "leble"=>"Driver Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "makedefaultcar"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "driver_id"=>array(
                            "leble"=>"Driver Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "vhcleid"=>array(
                            "leble"=>"Vehicle Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "userbasicdetails"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "user_type"=>array(
                            "leble"=>"User Type",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "ride_id"=>array(
                            "leble"=>"Ride Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "ridecurrentstatus"=>array(
                    "device_type"=>array(
                            "leble"=>"Device Type",
                            "type"=>"text",
                            "value"=>'1'
                    ),
                    "user_id"=>array(
                            "leble"=>"User Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "user_type"=>array(
                            "leble"=>"User Type",
                            "type"=>"text",
                            "value"=>'2'
                    ),
                    "ride_id"=>array(
                            "leble"=>"Ride Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "sendiospush"=>array(
                    "user_type"=>array(
                            "leble"=>"User Type",
                            "type"=>"text",
                            "value"=>'2'
                    ),
                    "device_id"=>array(
                            "leble"=>"Device Id",
                            "type"=>"text",
                            "value"=>''
                    ),
                    "alert"=>array(
                            "leble"=>"push alert",
                            "type"=>"text",
                            "value"=>''
                    ),
                ),
                "drivercommisiontest"=>array(),
				
				"returnCarDetails"=>array(
                    "device_type"=>array(
					"leble"=>"devicetype",
					"type"=>"text",
					"value"=>'1'
					),
					"user_id"=>array(
                            "leble"=>"User id",
                            "type"=>"text",
                            "value"=>'2'
                    ),
					"company_id"=>array(
                            "leble"=>"company_id",
                            "type"=>"text",
                            "value"=>'2'
                    ),
					
                ),
			"addVehicleService"=>array(
				"device_type"=>array(
					"leble"=>"Device Type",
					"type"=>"text",
					"value"=>'1'
				),
				"company_id"=>array(
					"leble"=>"company_id",
					"type"=>"text",
					"value"=>'1'
				),
				"user_id"=>array(
					"leble"=>"user_id",
					"type"=>"text",
					"value"=>''
				),
				"car_id"=>array(
					"leble"=>"car_id",
					"type"=>"text",
					"value"=>''
				),
				"car_model_id"=>array(
					"leble"=>"car_model_id",
					"type"=>"text",
					"value"=>''
				),
				"manufactureing_date"=>array(
					"leble"=>"manufactureing_date",
					"type"=>"text",
					"value"=>''
				),
				"vehicle_no"=>array(
					"leble"=>"vehicle_no",
					"type"=>"text",
					"value"=>''
				),
			),	
			
			"checkCityService"=>array(
			"device_type"=>array(
					"leble"=>"Device Type",
					"type"=>"text",
					"value"=>'1'
				),
				"lat"=>array(
					"leble"=>"pickup lat",
					"type"=>"text",
					"value"=>''
				),
				"long"=>array(
					"leble"=>"pickup long",
					"type"=>"text",
					"value"=>''
				),
				"company_id"=>array(
					"leble"=>"company_id",
					"type"=>"text",
					"value"=>'1'
				),
				
			),
			"fetch_driver_position"=>array(
				"ride_id"=>array(
					"leble"=>"Ride ID",
					"type"=>"text",
					"value"=>''
				),
				
				
				
			),	
			
			
	),
	
);
?>