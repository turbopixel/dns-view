<?php

header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$domain = ($_GET["domain"] ?? "");
if (empty($domain)) {
  echo json_encode(NULL);
  exit;
}


$parsed = parse_url($domain);

if (empty($parsed["host"])) {

  if (empty($parsed["path"])) {
    echo json_encode(["err" => "missing hostname"]);
    exit;
  }

}

$host = empty($parsed["host"]) ? $parsed["path"] : $parsed["host"];
$dig  = dns_get_record($host, DNS_CNAME + DNS_A + DNS_MX + DNS_NS + DNS_TXT + DNS_AAAA);

echo json_encode($dig);