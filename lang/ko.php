<?php
if(!defined('__XE__'))
{
	exit();
}

/** @var stdClass $lang */

/**
 * 기본 정보 관련
 */
$lang->upload_from_mobile_title = '모바일에서 업로드';
$lang->upload_from_mobile_description = 'PC 사용자가 모바일에서 파일을 업로드할 수 있도록 돕습니다.';

/**
 * 에디터 출력 페이지
 */
$lang->upload_from_mobile_btn_upload_from_mobile = '모바일에서 업로드';

/**
 * QR코드 출력 페이지
 */
$lang->upload_from_mobile_tit_upload_from_mobile = '모바일에서 업로드';
$lang->upload_from_mobile_txt_scan_from_mobile = '스마트폰 등에서 아래 QR코드를 스캔하여<br />해당 기기에 보관된 자료를 편하게 업로드 할 수 있습니다.';
$lang->upload_from_mobile_txt_expires_in = '이 링크는 %s초 동안 유효합니다.';
$lang->upload_from_mobile_txt_expired = '링크가 만료되었습니다.<br />창을 닫고 QR코드를 다시 발급해 주세요.';

/**
 * 세션 페이지
 */
$lang->upload_from_mobile_txt_upload_session = '아래 \'사진 및 파일 첨부\' 버튼을 클릭하여 파일을 첨부하세요.<br />첨부 후 잠시 기다리면 PC에서 첨부한 파일을 확인할 수 있습니다.';

/**
 * 만료 페이지
 */
$lang->upload_from_mobile_txt_session_expired = '만료된 링크입니다. 다시 시도해 주세요.';

/**
 * 관리자 페이지 메뉴
 */
$lang->upload_from_mobile_admin_menu_index = '대시보드';

/**
 * 관리자 페이지 대시보드
 */
$lang->upload_from_mobile_admin_tit_check_update = '업데이트 확인';
$lang->upload_from_mobile_admin_lbl_is_updated = '최신버전 여부';
$lang->upload_from_mobile_admin_txt_already_updated = '최신버전을 사용하고 있습니다! (버전 %s)';
$lang->upload_from_mobile_admin_txt_need_update = '최신버전으로 업데이트가 필요합니다! 깃헙에 방문하여 최신버전을 다운로드 받으세요. (버전 %s)';
$lang->upload_from_mobile_admin_lbl_github_url = '깃헙 URL';
$lang->upload_from_mobile_admin_txt_github_url = '네트워크 상태 불안정 등의 이유로 최신버전 정보가 부정확할 수 있습니다.<br />링크 접속 후 Watch -> Custom -> Releases 체크 후 Apply 버튼을 클릭하여 깃헙 알림센터를 통한 최신버전 알림을 받아볼 수 있습니다.';
$lang->upload_from_mobile_admin_lbl_advertisement = '커피한잔 대신 (광고)';
$lang->upload_from_mobile_admin_txt_advertisement_name = '제 컴퓨터에서는 작동하는데요?! 아니 진짜로 작동하는데 왜 거기서는 작동은 안하는지... 저는 잘 모르겠네요ㅎㅎ;';
$lang->upload_from_mobile_admin_txt_advertisement_url = 'https://smartstore.naver.com/dsticker/products/6518098733';

$lang->upload_from_mobile_admin_tit_config = '기본 설정';
$lang->upload_from_mobile_admin_lbl_expires_in = 'QR코드 만료시간';
$lang->upload_from_mobile_admin_txt_expires_in = '발급한 QR코드의 만료시간을 초 단위로 입력하세요. 입력하지 않거나 0으로 입력 시 무제한으로 간주됩니다.<br />설정한 만료시간과 관계없이 게시글 작성을 완료하면 발급된 QR은 자동으로 만료됩니다.';
$lang->upload_from_mobile_admin_txt_expires_in_infinity = '무제한';
$lang->upload_from_mobile_admin_lbl_qr_generating_type = 'QR코드 생성방법';
$lang->upload_from_mobile_admin_txt_qr_generating_type = 'QR코드를 생성할 방법을 선택해 주세요. 서버의 성능이 부족하다 판단될 경우 \'자체 생성\' 이외의 선택지를 선택하세요.';
$lang->upload_from_mobile_admin_txt_qr_generating_type_internal = '자체 생성';
$lang->upload_from_mobile_admin_txt_qr_generating_type_google_api = '구글 API';
