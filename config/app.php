<?php
declare(strict_types=1);
require_once __DIR__.'/database.php';
require_once __DIR__.'/auth.php';
function e(?string $v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function redirect(string $u): never { header("Location: $u"); exit; }
function flash(string $type,string $msg): void { $_SESSION["flash"]=[$type,$msg]; }
function show_flash(): void { if(!empty($_SESSION["flash"])){[$t,$m]=$_SESSION["flash"];echo '<div class="alert alert-'.e($t).' alert-dismissible fade show">'.e($m).'<button class="btn-close" data-bs-dismiss="alert"></button></div>';unset($_SESSION["flash"]);} }
function post_string(string $k): string { return trim((string)($_POST[$k]??'')); }
function require_post_csrf(): void { if($_SERVER["REQUEST_METHOD"]!=="POST" || !verify_csrf((string)($_POST["csrf_token"]??''))){http_response_code(419);exit("Token CSRF tidak valid.");} }
function can_edit_proposal(array $p): bool { $u=current_user(); return $u && (in_array($u["role"],["Admin LP2M","Sekretaris LP2M"],true) || ($u["role"]==="Dosen" && (int)$p["user_id"]===(int)$u["id"])); }
function can_delete_proposal(array $p): bool { $u=current_user(); return $u && ($u["role"]==="Admin LP2M" || ($u["role"]==="Dosen" && (int)$p["user_id"]===(int)$u["id"] && in_array($p["status"],["Draft","Ditolak"],true))); }
function upload_pdf(string $field,?string $old=null): ?string {
 if(empty($_FILES[$field])||$_FILES[$field]["error"]===UPLOAD_ERR_NO_FILE)return $old;
 if($_FILES[$field]["error"]!==UPLOAD_ERR_OK)throw new RuntimeException("Upload file gagal.");
 if($_FILES[$field]["size"]>5*1024*1024)throw new RuntimeException("Ukuran file maksimal 5 MB.");
 $ext=strtolower(pathinfo($_FILES[$field]["name"],PATHINFO_EXTENSION)); if($ext!=="pdf")throw new RuntimeException("File harus PDF.");
 $dir=__DIR__."/../uploads/proposals"; if(!is_dir($dir))mkdir($dir,0775,true);
 $name=bin2hex(random_bytes(12)).".pdf"; if(!move_uploaded_file($_FILES[$field]["tmp_name"],"$dir/$name"))throw new RuntimeException("File tidak dapat disimpan.");
 if($old && is_file("$dir/".basename($old)))@unlink("$dir/".basename($old)); return $name;
}
