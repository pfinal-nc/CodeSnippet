<?php
/**
 * Author: PFinal南丞
 * Date: 2024/9/14
 * Email: <lampxiezi@163.com>
 */


$file_path = "http://imgs.cbjzps.cn/Uploads/Audio/2024-09-14/202409141323091726291389466.pcm";

// 本地文件路径
$localFile = 'downloads/file.pcm';

// 打开远程文件
$remoteFile = fopen($file_path, 'rb');
if ($remoteFile === false) {
    die('无法打开远程文件');
}

// 打开本地文件用于写入
$localFileHandle = fopen($localFile, 'wb');
if ($localFileHandle === false) {
    fclose($remoteFile);
    die('无法创建本地文件');
}

// 将远程文件内容写入本地文件
while (!feof($remoteFile)) {
    // 从远程文件读取 1024 字节并写入本地文件
    fwrite($localFileHandle, fread($remoteFile, 1024));
}

// 关闭文件资源
fclose($remoteFile);
fclose($localFileHandle);

echo "文件已下载到: " . $localFile;