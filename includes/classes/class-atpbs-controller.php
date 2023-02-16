<?php

if ( ! class_exists( 'ATPBS_Controller' ) ) {
	class ATPBS_Controller {
		private $page_title = "Auto Publish Dashboard";
		private $menu_title = "Auto Publish";
		private $menu_slug 	= "auto_publish";
		private $capability = "manage_options";
		private $icon_url 	= "dashicons-tickets";
		private $position 	= 6;
		private $test_mode 	= false;

		public function __construct() {
			$this->run();
		}

		protected function run() {
			$this->add_actions();
			$this->add_filters();
			session_start();
		}
		protected function add_actions() {
			add_action( 'admin_menu', array( $this, 'register_custom_menu_page' ) );
			add_action( 'rest_api_init',array( $this, 'check_jwt_token' ) );
			add_action( 'rest_api_init',function () {
				register_rest_route( 'services', '/(?P<slug>[a-zA-Z0-9-]+)/', array(
				// register_rest_route( 'services', '/', array(
					'methods' => 'POST',
					'callback' => array( $this, 'publishing_bulk_pages_content' ),
					'args' => array('data'),
				));
			});

			add_action( 'wp_ajax_create_test_page', array( $this, 'create_test_page') );
			add_action( 'wp_ajax_nopriv_create_test_page', array( $this, 'create_test_page' ) );
		}

		protected function add_filters() {}

		public function create_test_page(){
			$this->test_mode = true;
			$this->publishing_bulk_pages_content(null);
		}
		public function register_custom_menu_page() {
			$page_title = "Auto Publish Dashboard";
			$menu_title = "Auto Publish";
			$capability = "manage_options";
			$menu_slug = "auto_publish";
			$callback = "auto_publish_dashboard";
			$icon_url = "dashicons-tickets";
			$position = 6;

			add_menu_page( 
				$this->page_title, 
				$this->menu_title, 
				$this->capability, 
				$this->menu_slug, 
				array( $this, 'auto_publish_dashboard' ), 
				$this->icon_url, 
				$this->position  
			);
			$wpdocs_cat = array('cat_name' => 'Basepage for ATPBS', 'category_description' => 'Basepage category for auto publishing plugin', 'category_nicename' => 'atpbs', 'category_parent' => '');
			$wpdocs_cat_id = wp_insert_category($wpdocs_cat);
		}

		public function auto_publish_dashboard (){
			require_once( ATPBS_DIR_PATH . 'includes/view/dashboard.php' );
		}

		public function publishing_bulk_pages_content($data) {
			// 	$slug = $data['slug'];
			$result 		= false;
			$error_msg 		= "";
			$result_msg 	= "";
			if ($this->test_mode){
				$json_data = '{
				"slug": "math-tutoring-saskatoon-sk",
				"cityName": "Saskatoon",
				"category": "Saskatoon",
				"keyword": "Math Tutoring",
				"metaTitle": "Best Math Tutoring in Saskatoon SK",
				"metaDescription": "Best Math Tutoring & Tutors Near Saskatoon. Saskatchewan qualified tutors for Grades K-12 Math. Free Assessment.",
				"faq": [{
						"question": "Flexible Math Tutoring Saskatoon scheduling to fit your needs",
						"answer": "Private math help is usually recommended when studying mathematics subjects like Algebra, Geometry, Trigonometry and Calculus because it helps reduce pressure on schoolwork since you won’t be tested until after completing the curriculum. Private maths sessions focus solely on solving problems rather than just teaching concepts which enables students to find solutions independently outside class. When attending maths tuition classes you must prepare yourself mentally beforehand in order to perform well once inside the classroom; otherwise, this could result disappointment due to inability to communicate effectively with the teacher in front of everyone else. Whether you’re struggling with basic arithmetic questions, long division to quadratic equations, geometry, trigonometry or calculus homework, our qualified tutors work with your individual schedule and provide the optimal solution for your unique needs. We always strive to accommodate whatever hour windows suit your busy lifestyle, whether that’s early morning, afternoon, weekend days or evening hours. Our team of highly experienced teachers offer customized lessons designed around what they believe would benefit you most. We deliver real hands-on experience via step by step instructions coupled with interactive online videos, making us stand apart from other tutors in the market today. At TutorOne we take pride in helping other people get better equipped towards higher education outcomes through personalized attention and practical guidance, no matter your age or background. Whether you want some extra tips and tricks on algebra, differential equation derivation, statistics, linear programming, probability theory or introductory quantum mechanics, we’d love nothing more than to assist you in becoming smarter tomorrow. Visit our website http://www.TutorOne.ca/math-help/Saskatoon/learn-better-at-home today and discover why thousands worldwide trust their educational futures to us..<br>Website Name: TUTORONE<br>URL Domain: www.tutorone.ca<br>Social Media Profile Link: https://www.facebook.com/Tutorene<br>Twitter Handle @TutorOne_CA<br>LinkedIn Page: https://www."
					},
					{
						"question": "Qualified Math Tutor(s) Saskatoon",
						"answer": "Mathematics isn’t just numbers & symbols anymore! Today’s math learners face increasingly complex problems that demand creativity, critical thinking, problem solving skills, communication expertise, teamwork and other life lessons.<br>Here’s why private Math classes can help your child thrive & become well prepared for all aspects of their life.<br>At the end of this article, click the green “Get Started” button to see our best deal which includes 30 minutes per week online with 2 different subject experts. We’ll take care of scheduling our own lesson times after that.<br>Why Private Tutoring Is Different From Public Classes?<br>If math seems like foreign language to you, then private tuition could be exactly the solution you’ve been searching for! Private mathematics lessons might seem boring, but they’re actually fun - especially if your children enjoy the topic. Private classrooms offer flexibility without additional fees outside of normal school hours. These sessions allow families to develop personalized strategies together. All of our teachers are highly qualified, experienced professionals who specialize in teaching both pre K–12th grade concepts and academic subjects. They go above and beyond to ensure your kids learn everything necessary to be successful in school, including advanced practice questions, real world applications, project-based learning assignments and plenty of homework/tests along the way! Plus, you get to pick your teacher instead of having to settle. Find us HERE<br>When Do Tuition Fees Start For A New Student?<br>For new students interested in studying math, here’s a quick breakdown of what monthly costs come standard with most programs:<br>• Full Time student ($1,200-$3,600 depending on location)<br>• Part-Time student $800 every four weeks<br>• Half Day / After School Programs $500<br>• Private Lessons starting at only $40/hour!<br>What Can I Study At Tutor One?<br>From Geometry to Algebra, you can really study anything you’d like once you begin attending our exclusive online program."
					},
					{
						"question": "Find a Math tutor near you in Saskatoon SK",
						"answer": "This week marks my 7th anniversary teaching math lessons online for Tutor1. I have taught thousands of students across Canada. My passion for teaching continues to evolve every day, especially after meeting and connecting with my student community through Facebook.<br>I created this webinar specifically to provide parents/students with information regarding private math instruction in Saskatoon. Parents often ask me why they should pay tuition for private math classes instead of having their child take part in traditional school classrooms. Below are several key reasons:<br>Private Math Classes Offer Flexibility And Control For Students<br>Students who attend private math sessions benefit from working closely with their math teacher. They learn better because math is broken down into small steps, allowing students to focus their attention and retain content easily. Private math teachers will work alongside their young students to help identify which concepts are challenging or confusing. By understanding these things early on, students will be able to avoid falling behind during regular school hours and catch up quickly once class resumes in September.<br>Math Lessons Are Customized To Meet Student Needs<br>Parents who hire us understand that no two kids are alike. Some students prefer doing hands-on activities; some like writing problems on paper; and still other students simply love practicing formulas. Our tutors will always adapt their curriculum to match each individual student’s needs. If students feel confident in their ability to complete homework assignments independently, then our instructors won’t assign extra practice questions to ensure those abilities stand true when test day arrives. We want to see students’ true potential shine.<br>We Provide Real-time Feedback On Classroom Learning & Progress<br>Many students struggle with retaining mathematical knowledge due to the fact most schools only offer math textbooks and standardized tests rather than personalized feedback on classroom learning. When students receive immediate praise when answering questions correctly, they tend to become motivated to keep studying. As soon as students reach mastery level in our classroom tutorials, they immediately move onto next lesson."
					},
					{
						"question": "Grades K-12 Math Tutoring Saskatoon",
						"answer": "This guide will cover topics related to math courses in both primary/secondary school settings as well as post secondary education institutions like Universities and Colleges as per the current syllabus across Canada.<br>We provide tuition services in mathematics from grade level 1 through 12 levels depending upon the subjects covered in curriculum of schools and universities in different provinces including Ontario, Quebec, Nova Scotia, New Brunswick and Alberta. Our qualified, experienced math teachers who work closely with parents to help children improve in this subject matter are available Monday to Friday after school hours between 2 PM to 8 PM PST every week day. They use innovative strategies and teach concepts which allow learners gain confidence, develop problem solving abilities, increase attention span as well as enhance reading comprehension skills and ultimately prepare kids for post secondary educational institutions as they apply towards higher degrees. If you would like to learn more about us then please feel free to contact us via email to schedule an appointment and see for yourself why hundreds of clients around the globe choose Tutor One as their trusted source whenever they need assistance with math problems.<br>TutorOne’s objective is to assist students understand mathematical principles while developing critical thinkers and problem solvers. We believe that a student should be able to achieve mastery regardless of his or her background knowledge. All topics taught under the umbrella of Mathematics are aligned with the Canadian Curriculum and Assessment Authority standards in order to ensure quality curriculum delivery. For instance, students enrolled in TutorOne classes receive feedback on homework assignments, tests and quizzes to better assess whether or not they meet expectations as laid out by the board of directors. Additionally, these guidelines outline what constitutes high marks, failing grades and passing scores, therefore allowing tutors to tailor curriculums according to individual needs and strengths. Students are provided ample opportunities for group discussion and peer assessment sessions where instructors work together to foster positive relationships and encourage constructive dialogue among pupils; thus ensuring greater understanding on a conceptual level as well as improving overall academic achievement."
					},
					{
						"question": "Benefits of qualified Math tutors in {city}.",
						"answer": "Math tutoring helps kids excel in high school and beyond. But why should parents consider hiring math tutors instead of teachers? Here’s why: 1) Teachers’ lessons often fall short because students struggle with concepts they don’t get taught well enough 2) A good teacher understands his/her subject thoroughly but a great tutor goes above and beyond to understand her student’s weaknesses 3) When teaching Math, most teachers tend to focus on memorization without understanding the real concept behind the question 4) Good tutors help prepare children for SAT or ACT exams 5) Most importantly, a good tutor creates eurekas—moments of inspiration that lead to “ah ha” discoveries that transform struggling students into advanced learners. If this sounds like something that would benefit your child, then call us today. We’re waiting to hear from you.<br>Tutor One offers private instruction, online tutoring services, group coaching sessions, summer programs/classes, homework assistance & after-school tutoring. Call us at 306.564.5500 today for details."
					},
					{
						"question": "How To Get An A+ In K-12 Math Classes",
						"answer": "This tutorial will help students achieve higher scores through engaging lessons and homework assignments tailored specifically to their needs. Students won’t receive generic workbooks with assigned math questions and exercises that aren’t relevant to them which often lead to subpar test scores across grade levels. Our teachers use the most efficient tools available to teach math effectively including problem solving strategies, graphing techniques, real world applications, and critical thinking practices.<br>Whether they’re working together in groups, individually, online, via videoconferencing or virtual classrooms; our qualified instructors utilize instructional methodologies designed to enhance student achievement both academically and emotionally. They take pride in making education fun and enjoyable, helping children learn math concepts in an effective manner, leading them towards greater academic accomplishment. All of this makes us the experts in Math Education Services.<br>At MyTutor One™ our students are provided with 24/7 customer support to ensure fast response times and a positive experience every step of the way. If you would like further information about maths services offered for students in Ontario, please contact us today. We proudly provide quality tutoring service in Mathematics to many schools and educational institutions around Toronto<br>MyTutor One is committed to serving families who value excellence in teaching methods and strive to help parents find excellent resources for learning mathematics. As well as supporting home school instruction to improve outcomes for individual pupils, we offer professional development programs and consulting services to local government agencies and business organizations that seek assistance improving K-18 math program offerings in public, private, charter, and independent secondary schools. Whether teaching young elementary aged kids in small rural communities, or high achieving adolescents, our staff uses creative and exciting approaches to engage young minds and get the job done efficiently. At an earlier stage than traditional classroom sessions, we begin to develop strong relationships with students, parents, friends, community members and other educators through individualized tutorials."
					},
					{
						"question": "Math Tutoring and Classes Near Me in Saskatoon",
						"answer": "Math is known by many as “the language of the universe”. And, this mathematical equation holds true especially in Canada. Statistics released by Statscan show just how crucial math courses are in Canadian schools for kids who wish to pursue further education after high school. In fact, they say that students are required to take 12 hours of maths courses per semester across their secondary years of schooling. While these numbers aren’t exactly shocking, knowing which cities/towns provide quality mathematics classes near me should be.<br>Saskatchewan isn’t lacking in top-notch math lessons for teens. As shown in this map, several educational hubs boast highly effective curriculum teaching methods through private tutoring sessions, online instruction, and classroom programs. Not only does this allow children who cannot afford or find local tuition to enjoy great academic experiences; but teachers receive invaluable experience. After seeing and hearing how some students improve dramatically, they’re motivated to bring similar improvements to the next generation of learners. Here’s everything you could learn during this journey through Saskatchewan.<br>Map of Educational Centers & Private School Lessons<br>Caveat 1: These maps are meant as general guides. They highlight areas rich in various services offered by different establishments. We encourage readers to research individual schools independently rather than relying solely on data provided by us.<br>Caveats 2: Some tutoring centers listed offer services outside of mathematics, though most focus heavily on Math. The listings below reflect only those locations offering comprehensive math solutions. Additionally, note that while the average price ranges vary widely among our featured businesses, prices listed represent approximate costs. Please keep this discrepancy in mind prior to making a final decision on the spot which fits your needs best."
					},
					{
						"question": "How Can I get my child to love Math?",
						"answer": "Why should children learn math? This question needs answering before starting with lessons to understand why kids and adults alike find this subject interesting to study. Children who excel in Mathematics tend to become better problem solvers across many other subjects, which makes them highly employable upon graduation.<br>There is no doubt that mathematics plays an integral role in shaping careers; hence, understanding basic concepts such as fractions, decimals and percentages could be beneficial by helping kids realize they can solve problems like these without difficulty after just a few sessions with our experienced teachers.<br>But while studying maths can prove advantageous for individuals aiming to join professional fields such as engineering, medicine, law, or accounting; some parents struggle to entice youngsters towards this area of expertise. One way to achieve better outcomes during tuition could come in the form of personalized attention as opposed to following a standard curriculum taught at school. Our teacher friendly programs offer individualized approaches that allow us to cater specifically to each student’s personal preferences. And thanks to technology, every session remains virtual and engaging. All things considered, tutoring online offers kids around Saskatoon, SK greater flexibility than traditional classes, allowing them to fit schooling into their busy schedules.<br>TutorOne strives to provide excellent service by ensuring students and parents feel confident in choosing our company when selecting private schools near Saskatoon, Saskatchewan. We offer great value for money and strive always to deliver superior customer experience through our unique approach to teaching and education. Whether you are interested in improving your current grade level, or want to catch up on a topic with which you struggled at school, our experts aim to address specific weaknesses by customising curricula, breaking down complex topics step-by-step and delivering content via digital material to ensure comprehension. As mentioned previously, we believe everyone learns differently and tailor our instruction methods accordingly."
					},
					{
						"question": "Best Math Tutoring Saskatoon SK",
						"answer": "This article is about the importance of having math tutored. If you’re looking for help with homework then you’ve come to the right place because this post covers everything you need to know about the subject including why math classes are useful, which subjects should be studied first, why math helps you get better grades, what types of tutoring services exist and why they work and much more...<br>Tutoring Services in Saskatoon<br>If you live in Saskatoon and are wondering whether you should go down the road of hiring someone else to teach your child maths then keep scrolling...<br>Why Should I Hire A Private Math Teacher For My Child?<br>If you ask most people who study math, they would probably reply that maths is something everyone needs to understand. However, the truth is that some people find mathematics harder than many other things. So if you think that your child struggles with maths then you may want to consider getting some professional guidance to see why he or she is facing difficulties and what could possibly be causing these issues.<br>There are lots of different ways to go through maths lessons. One thing is that you can use online resources like websites, apps, books and videos to learn maths. But another way is to hire a tutor to help your child learn the basics of mathematics in order to improve his or her overall mathematical ability as well as his or her academic scores."
					},
					{
						"question": "Free Math Tutoring Assessment at Saskatoon Location",
						"answer": "If it sounds like something you could benefit from then read on because you’ll discover why math for some people is still considered “the language they speak inside only.” But whether it’s Algebra, Trigonometry, Precalculus, Calculus I & II, Differential Equations, Linear Systems or Statistics, maths can be intimidating especially if you don’t understand the core concepts well enough yet. So who better than someone trained just for teaching math to help you get those numbers straightened out fast?!<br>At Tutor One Private Solutions Inc.we don’t believe you should struggle with math anymore! Because we’re fully committed to helping learners excel at subjects they previously struggled with and feel good whenever they come back to us after achieving greater mastery through individualized sessions, customized classes, homework assignments and regular quizzes.<br>So don’t wait any longer; book today and find yourself excelling again soon! We look forward seeing how this course was able to positively impact you!<br>Best Regards, Tutor1 Team<br>Tutor 1 is available Monday to Friday during business hours 9am-7pm CST | Saturday 8am-5pm CST<br>Monday to Thursday evenings 5pm-8pm MST | Saturday 7am-4pm MST<br><br>This post contains affiliate links which allow me to earn commissions when you purchase a product recommended in posts but rest assured I will always recommend products and services that I sincerely use and love myself. Read my disclosure policy. For questions related specifically to tutoring click HERE! For general inquiries contact me via email or text message. Thanks! 🙂<br><br>Post navigation<br><br>3 thoughts on “How To Make Your Website More Desirable By 2020”<br><br>Hi John, thank you for sharing information about website design and development. As I am planning to launch my own website soon, and would appreciate your comments and feedback. Kindly reach out to me if possible."
					}],
				"stateName": "Saskatchewan"
				}';
			}else{
				$json_data = $data['data'];
			}
			$json_obj = json_decode($json_data);
			// $city_list = array('Vancouver','Ottawa');
			$city_list = array('Toronto','Vancouver','Ottawa','Edmonton','Oshawa','Hamilton','Winnipeg','Montreal','Calgary');
			
			$base_page_id = get_option('_j_basepage_id');
			if ($base_page_id && $base_page_id > 0){
				$content_post = get_post($base_page_id);
				$standard_content = $content_post->post_content;
				$standard_cornerstone_content = get_post_meta( $base_page_id, '_cornerstone_data', true );
				$_cs_generated_tss = get_post_meta( $base_page_id, '_cs_generated_tss', true );

				global $table_prefix,$wpdb;
				$post_table = $table_prefix . "posts";
				$postmeta_table = $table_prefix . "postmeta";
				$automating_post_id = $base_page_id;
				$slug = $json_obj->slug;
				$faq = $json_obj->faq;
				$__cityName__ = $json_obj->cityName;
				$__stateName__ = $json_obj->stateName;
				$__keyword__ = $json_obj->keyword;
				$__metaDescription__ = $json_obj->metaDescription;
				$__metaTitle__ = $json_obj->metaTitle;
				$category = $json_obj->category;
				
				$_aid = 0;
				$faq_item_count = 0;
				// -----------------posts post content--------------------------
				preg_match('/\[cs_element_accordion(.*?)\[\/cs_element_accordion]/s', $standard_content, $faq_content_match);
				if (isset($faq) && !empty($faq_content_match)){
					$faq_content_part = $faq_content_match[0];
					$faq_content_main_content =  $faq_content_match[0];
					$_n1 = strpos($faq_content_main_content, '_id=');
					$_n2 = strpos($faq_content_main_content, '" ]');
					$faq_content_begin_num = substr($faq_content_main_content,$_n1+5,$_n2-$_n1-5);
			
					$_m1 = strrpos($faq_content_main_content, 'cs_element_accordion_item');
					$_m2 = strrpos($faq_content_main_content, '" ]');
					$faq_content_end_num = substr($faq_content_main_content,$_m1+strlen('cs_element_accordion_item _id="'), $_m2-$_m1-strlen('cs_element_accordion_item _id="'));

					$standard_content = str_replace($faq_content_part,'__faq__',$standard_content);
					
					$faq_item_count = intval($faq_content_end_num) - intval($faq_content_begin_num);
					$faq_accordian_item_begin_id = $faq_content_begin_num + 1;
					
					// -----------------postmeta standard content--------------------------
					$cornerstone_main_content =  $standard_cornerstone_content;
					$_c1 = strpos($cornerstone_main_content, '{"_type":"accordion"');
					$_s1 = strrpos($cornerstone_main_content, 'accordion_item_header_content');
					$_s2 = strpos($cornerstone_main_content, '}]},', $_s1);
					$faq_cornerstone_data_part = substr($cornerstone_main_content,$_c1, $_s2-$_c1-1);
					// $faq_cornerstone_data_part = substr($cornerstone_main_content,$_c1, $_s2-$_c1+strlen('}]},'));
					$standard_cornerstone_content = str_replace($faq_cornerstone_data_part,'__faq__',$standard_cornerstone_content);
					
					// -----------------postmeta css generate tss-------------------------- 
					$tss_main_content =  $_cs_generated_tss;
					$_t1 = strpos($tss_main_content, '"el:'.$faq_accordian_item_begin_id.'"');
					
					$_p1 = strrpos($tss_main_content, '"el:'.$faq_content_end_num.'"');
					$_p2 = strpos($tss_main_content, '[]}', $_p1);
					
					$faq_tss_content = substr($tss_main_content,$_t1, $_p2-$_t1+strlen('[]}'));
					$_cs_generated_tss = str_replace($faq_tss_content,'__faq_tss_content__',$_cs_generated_tss);
					// // ------------------------------------------------------------------
					
					$faq_cornerstone_content = '';
					$faq_tss_content = '';
					$faq_cornerstone_content .= '{"_type":"accordion","_bp_base":"4_4","_modules":[';
					$faq_content = '[cs_element_accordion _id="'.$faq_content_begin_num.'" ]';
					if (is_array($faq)){
						foreach ($faq as $fkey => $fvalue) {
							$question = $fvalue->question;
							$answer = $fvalue->answer;
							$faq_cornerstone_content .= '{"_type":"accordion-item","_bp_base":"4_4","accordion_item_content":"A: '.$answer.'","accordion_item_header_content":"Q: '.$question.'","_modules":[]},';
							$_accordion_item_id = $faq_accordian_item_begin_id + $_aid + 1 ;
							$faq_content .='[cs_element_accordion_item _id="'. $_accordion_item_id .'" ][cs_content_seo]Q: '.$question . '\n\nA: ' . $answer . '\n\n[/cs_content_seo]';
							$faq_tss_id = $faq_accordian_item_begin_id + $_aid;
							$faq_tss_content .= '"el:'.$faq_tss_id.'": {"dynamic-content": []},';
							$_aid++; 
						}
					}
					$faq_cornerstone_content = rtrim($faq_cornerstone_content, " ,");
					$faq_cornerstone_content .= ']}';
					$faq_content .= '[/cs_element_accordion]';
					$standard_content = str_replace('__faq__',$faq_content,$standard_content);
					$standard_cornerstone_content = str_replace('__faq__',$faq_cornerstone_content,$standard_cornerstone_content);
					$tss_arr = explode ('},"',$_cs_generated_tss);
					$tss_index_arr = [];
					foreach ($tss_arr as $tkey => $tvalue) {
						$t_index = substr(strstr(stristr($tvalue,"el:"), '"', true),3);
						if (preg_match('/\d+/', $t_index, $mat)) $tss_index_arr[] = $mat[0];
					}
				
					$new_tss_index_arr = array_map(function($n) {
							global $_aid;
							if ($n > $faq_accordian_item_begin_id ) {
								return $n - $faq_item_count + $_aid;
							} else {
								return $n;
							}
						}, $tss_index_arr
					);
					$old_tss_el_arr = array_map(function($n) {
							return '"el:'.$n.'"';
						}, $tss_index_arr
					);
					$new_tss_el_arr = array_map(function($n) {
							return '"el:'.$n.'"';
						}, $new_tss_index_arr
					);
					$_cs_generated_tss = atpbs_replace_index_in_array($old_tss_el_arr,$new_tss_el_arr,$_cs_generated_tss);
					$_cs_generated_tss = str_replace('__faq_tss_content__',$faq_tss_content ,$_cs_generated_tss);
				}
			
				$new_cs_generated_tss = str_replace('\"',"'" ,$_cs_generated_tss);
				$new_content = str_replace('{CITY}',$__cityName__,$standard_content);
				$new_content = str_replace('{STATE}',$__stateName__,$new_content);
				$new_content = str_replace('{KEYWORD}',$__keyword__ ,$new_content);
			
				$new_cornerstone_content = str_replace('{CITY}',$__cityName__,$standard_cornerstone_content);
				$new_cornerstone_content = str_replace('{STATE}',$__stateName__,$new_cornerstone_content);
				$new_cornerstone_content = str_replace('{KEYWORD}',$__keyword__ ,$new_cornerstone_content);
			
			
				$source_post =(array) get_post($automating_post_id);
				$new_post = $source_post;
				$new_time = current_time('mysql');
			
				// category part
				$category_arr = explode(",",$category);
				$post_cat = array();
				foreach ($category_arr as $ckey => $cvalue) {
					$term = term_exists( $cvalue, 'category' );
					if ( $term !== 0 && $term !== null ) {
						$cat_id = $term['term_id'];
					}else{
						if ($term = wp_insert_term($cvalue,'category')){
							$cat_id = $term['term_id'];
						}
					}
					$post_cat[] = $cat_id;
				}
				$tags_arr = explode(",",$__keyword__);
				
				$title = $__cityName__ . "-" . $__keyword__ . "," . $__stateName__;
				$new_post["post_content"] = $new_content;
				$new_post["post_name"] = $slug;
				$new_post["post_title"] = $title;
				$new_post["post_date"] = $new_time;
				$new_post["post_date_gmt"] = get_gmt_from_date( $new_time );
				$new_post["post_modified"] = $new_time;
				$new_post["post_modified_gmt"] = get_gmt_from_date( $new_time );
				$new_post["post_category"] = $post_cat;
			
				unset($new_post["ID"]);
				$new_post_id = wp_insert_post($new_post);
				
				wp_set_post_tags( $new_post_id, $tags_arr, true );
			
				$post_name = $slug."-".$new_post_id;
				// $guid = "https://tintingtitans.com/?page_id=".$new_post_id;
				$guid = get_site_url() . "/?page_id=".$new_post_id;
				$res = $wpdb->update( $post_table, array("guid"=> $guid), array("ID" => $new_post_id) );
				$rows_affected = $wpdb->query(
					"INSERT INTO `$postmeta_table` ( post_id, meta_key, meta_value)
					SELECT  $new_post_id, meta_key, meta_value
					FROM  `$postmeta_table`
					WHERE post_id = $automating_post_id;"
				);
			
				update_post_meta( $new_post_id, '_cornerstone_data', addslashes($new_cornerstone_content));
				
				// update_post_meta( $new_post_id, '_cs_generated_tss', $new_cs_generated_tss );
				update_post_meta( $new_post_id, '_j_keyword', $__keyword__ );
				update_post_meta( $new_post_id, '_j_cityName', $__cityName__ );
				update_post_meta( $new_post_id, '_j_stateName', $__stateName__ );
				update_post_meta( $new_post_id, 'rank_math_title', $__metaTitle__ );
				update_post_meta( $new_post_id, 'rank_math_description', $__metaDescription__ );
			
				if ($res && $rows_affected){
					$result_msg = "Post $new_post_id is published successfully. Click <a href='".get_permalink($new_post_id)."'>here</a> to visit this page.";
					$result = true;
				}
			}else{
				$result = false;
				$error_msg = "Base Page ID Error";
			}
			return wp_send_json(array('result'=>$result,'error_msg' => $error_msg,'result_msg'=> $result_msg, 'debug_res'=>$base_page_id)); 
		}
		
		public function check_jwt_token(){
			register_rest_route( 'jwtoken', '/?username=(?P<username>[a-zA-Z0-9-]+)&password=(?P<password>)', array(
				'methods' => 'GET',
				'callback' => array( $this, 'get_users_jwt_data' ),
			));
		}
		public function get_users_jwt_data($data){
			$user = get_user_by( 'login', trim($data['username']) );
			if ($user){
			// if( "joe@seolo.ca" === trim($data['username'])) {
				// if( "(cBbCsg1ua6B9xmF" === trim($data['password'])){
				if ( wp_check_password( trim($data['password']), $user->data->user_pass, $user->ID) ){
					if (user_has_role($user->ID, 'subscriber')){
						$result=array(
							"status"=>true,
						);
					}else{
						$result=array(
							"status"=>false,
							"msg"=>"Invalid permission"
						);
					}
				}else{
					$result=array(
						"status"=>false,
						"msg"=>"Invalid password"
					);
				}
			}else{
				$result=array(
					"status"=>false,
					"msg"=>"Invalid username"
				);
			}
			echo wp_json_encode($result);
		}
	}
}

new ATPBS_Controller();

