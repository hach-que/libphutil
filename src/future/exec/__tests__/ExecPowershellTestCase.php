<?php

final class ExecPowershellTestCase extends PhutilTestCase {

  private function getOnlyPowershellXML() {
    return
      '#< CLIXML'."\r\n".
      '<Objs Version="1.1.0.1" xmlns="http://schemas.microsoft.com/powershell/'.
      '2004/04"><S S="Error">cd Z:\366_x000D__x000A_</S><S S="Error">trap_x000'.
      'D__x000A_</S><S S="Error">{_x000D__x000A_</S><S S="Error">  #try {_x000'.
      'D__x000A_</S><S S="Error">  #  #$Host.UI.WriteErrorLine($_)_x000D__x000'.
      'A_</S><S S="Error">  #} catch {_x000D__x000A_</S><S S="Error">  #  #[Mi'.
      'crosoft.PowerShell.Commands.WriteErrorException]_x000D__x000A_</S><S S='.
      '"Error">  #  #Write-Host $__x000D__x000A_</S><S S="Error">  #}_x000D__x'.
      '000A_</S><S S="Error">    _x000D__x000A_</S><S S="Error">  #exit 1_x000'.
      'D__x000A_</S><S S="Error">}_x000D__x000A_</S><S S="Error">try {_x000D__'.
      'x000A_</S><S S="Error">  Write-Host "TEST"; Write-Error _x000D__x000A_<'.
      '/S><S S="Error">"&lt;xml&gt;microsoft&lt;you&gt;better&lt;not&gt;suck&l'.
      't;/not&gt;&lt;/you&gt;&lt;/xml&gt;&lt;S WHOOOOPS&gt;"_x000D__x000A_</S>'.
      '<S S="Error">} catch {_x000D__x000A_</S><S S="Error">  Write-Host "exce'.
      'ption occurred"_x000D__x000A_</S><S S="Error">  exit 1_x000D__x000A_</S'.
      '><S S="Error">}_x000D__x000A_</S><S S="Error">if ($LastExitCode -ne 0) '.
      '{_x000D__x000A_</S><S S="Error">  exit $LastExitCode_x000D__x000A_</S><'.
      'S S="Error">} : &lt;xml&gt;microsoft&lt;you&gt;better&lt;not&gt;suck&lt'.
      ';/not&gt;&lt;/you&gt;&lt;/xml&gt;&lt;S WHOOOOPS&gt;_x000D__x000A_</S><S'.
      ' S="Error">    + CategoryInfo          : NotSpecified: (:) [Write-Error'.
      '], WriteErrorExcep _x000D__x000A_</S><S S="Error">   tion_x000D__x000A_'.
      '</S><S S="Error">    + FullyQualifiedErrorId : Microsoft.PowerShell.Com'.
      'mands.WriteErrorExceptio _x000D__x000A_</S><S S="Error">   n_x000D__x00'.
      '0A_</S><S S="Error"> _x000D__x000A_</S></Objs>';
  }

  private function getIntermixedPowershellXML() {
    return
      'whatever blah blah blah blah.'."\r\n".
      'some other lines here.'."\r\n".
      'microsoft y u do dis'."\r\n".
      '#< CLIXML'."\r\n".
      '<Objs Version="1.1.0.1" xmlns="http://schemas.microsoft.com/powershell/'.
      '2004/04"><S S="Error">abcdefghi_x000D__x000A_</S><S S="Error">At line:1'.
      ' char:1_x000D__x000A_</S><S S="Error">+ abcdefghi _x000D__x000A_</S><S '.
      'S="Error">-Force_x000D__x000A_</S><S S="Error">+ _x000D__x000A_</S><S S'.
      '="Error">~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~'.
      '~~~~~~~~~~~~~~~~_x000D__x000A_</S><S S="Error">    + CategoryInfo      '.
      '    : NotSpecified: (:) [Stop-EC2Instance], AmazonEC2E _x000D__x000A_</'.
      'S><S S="Error">   xception_x000D__x000A_</S><S S="Error">    + FullyQua'.
      'lifiedErrorId : Amazon.EC2.AmazonEC2Exception,Amazon.PowerShell. _x000D'.
      '__x000A_</S><S S="Error">   Cmdlets.EC2.StopEC2InstanceCmdlet_x000D__x0'.
      '00A_</S><S S="Error"> _x000D__x000A_</S></Objs>'."\r\n";
  }

  private function getOnlyPowershellExpected() {
    return
      'cd Z:\366'."\r\n".
      'trap'."\r\n".
      '{'."\r\n".
      '  #try {'."\r\n".
      '  #  #$Host.UI.WriteErrorLine($_)'."\r\n".
      '  #} catch {'."\r\n".
      '  #  #[Microsoft.PowerShell.Commands.WriteErrorException]'."\r\n".
      '  #  #Write-Host $_'."\r\n".
      '  #}'."\r\n".
      '    '."\r\n".
      '  #exit 1'."\r\n".
      '}'."\r\n".
      'try {'."\r\n".
      '  Write-Host "TEST"; Write-Error '."\r\n".
      '"<xml>microsoft<you>better<not>suck</not></you></xml><S WHOOOOPS>"'.
      "\r\n".
      '} catch {'."\r\n".
      '  Write-Host "exception occurred"'."\r\n".
      '  exit 1'."\r\n".
      '}'."\r\n".
      'if ($LastExitCode -ne 0) {'."\r\n".
      '  exit $LastExitCode'."\r\n".
      '} : <xml>microsoft<you>better<not>suck</not></you></xml><S WHOOOOPS>'.
      "\r\n".
      '    + CategoryInfo          : NotSpecified: (:) [Write-Error], WriteErr'.
      'orExcep '."\r\n".
      '   tion'."\r\n".
      '    + FullyQualifiedErrorId : Microsoft.PowerShell.Commands.WriteErrorE'.
      'xceptio '."\r\n".
      '   n'."\r\n".
      ' '."\r\n";
  }

  private function getIntermixedPowershellExpected() {
    return
      'whatever blah blah blah blah.'."\r\n".
      'some other lines here.'."\r\n".
      'microsoft y u do dis'."\r\n".
      'abcdefghi'."\r\n".
      'At line:1 char:1'."\r\n".
      '+ abcdefghi '."\r\n".
      '-Force'."\r\n".
      '+ '."\r\n".
      '~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~'.
      '~~~~~~~'."\r\n".
      '    + CategoryInfo          : NotSpecified: (:) [Stop-EC2Instance], Ama'.
      'zonEC2E '."\r\n".
      '   xception'."\r\n".
      '    + FullyQualifiedErrorId : Amazon.EC2.AmazonEC2Exception,Amazon.Powe'.
      'rShell. '."\r\n".
      '   Cmdlets.EC2.StopEC2InstanceCmdlet'."\r\n".
      ' '."\r\n";
  }

  public function testParseOnlyPowershellXML() {
    $powershell = $this->getOnlyPowershellXML();

    list($parsed, $consumed) =
      id(new ExecFuture(''))->parsePowershellXML($powershell);
    $expected = $this->getOnlyPowershellExpected();

    $parsed = str_replace("\r", '', $parsed);
    $expected = str_replace("\r", '', $expected);

    $this->assertEqual($expected, $parsed);
  }

  public function testParseIntermixedPowershellXML() {
    $powershell = $this->getIntermixedPowershellXML();

    list($parsed, $consumed) =
      id(new ExecFuture(''))->parsePowershellXML($powershell);
    $expected = $this->getIntermixedPowershellExpected();

    $parsed = str_replace("\r", '', $parsed);
    $expected = str_replace("\r", '', $expected);

    $this->assertEqual($expected, $parsed);
  }

  public function testExecOnlyPowershellXML() {
    $file = id(new TempFile());
    Filesystem::writeFile($file, $this->getOnlyPowershellXML());

    list($stdout, $stderr) = id(new ExecFuture('cat %s >&2', $file))
      ->setPowershellXML(true)
      ->resolvex();

    $expected = $this->getOnlyPowershellExpected();

    $stderr = str_replace("\r", '', $stderr);
    $expected = str_replace("\r", '', $expected);

    $this->assertEqual($expected, $stderr);
  }

  public function testExecIntermixedPowershellXML() {
    $file = id(new TempFile());
    Filesystem::writeFile($file, $this->getIntermixedPowershellXML());

    list($stdout, $stderr) = id(new ExecFuture('cat %s >&2', $file))
      ->setPowershellXML(true)
      ->resolvex();

    $expected = $this->getIntermixedPowershellExpected();

    $stderr = str_replace("\r", '', $stderr);
    $expected = str_replace("\r", '', $expected);

    $this->assertEqual($expected, $stderr);
  }
}
