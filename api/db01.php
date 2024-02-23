
DB檔整理
Vscode 裏面去下載 Partial Diff 來比較兩個檔案差異。

class DB 裏面 總共 13 個 function
public function construct($table)
function all( $where = '', $other = '')
function count( $where = '', $other = '')
private function math($math,$col,$array='',$other='')
function sum($col='', $where = '', $other = '')
function max($col, $where = '', $other = '')
function min($col, $where = '', $other = '')
function find($id)
function del($id)
function save($array)
function q($sql)
private function a2s($array)
private function sql_all($sql,$array,$other)


先寫三個  protected 
1.先背 public function construct($table)

2.再背 
      function q
      private function a2s
      private function sql_all
      function all
      function count

3.再背
      private function math
      function sum
      function max
      function min

4.再背
      function find
      function del
      function save


db 以外的二個 function
      function dd
      function to

fetchAll(PDO::FETCH_ASSOC) 有三個
         function all
         function q
         function find

fetchColumn() 有二個
         function count
         function math


exec($sql)   有二個
         function save
         function del
