#!/usr/bin/python
import os
from subprocess import Popen, PIPE, STDOUT
import unittest

class Test_ex00(unittest.TestCase):
	def test_ex00(self):
		proc = Popen("php ex00/hw.php", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("Hello World\n", re)

class Test_ex01(unittest.TestCase):
	def test_ex01(self):
		proc = Popen("php ex01/mlx.php", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		my_str = "";
		for x in range(0, 1000):
			my_str = my_str + "X";
		my_str = my_str + '\n'
		self.assertEqual(len(re), 1001)
		self.assertEqual(re, my_str)

class Test_ex02(unittest.TestCase):
	def test_ex02_0(self):
		proc = Popen("php ex02/oddeven.php", shell=True, stdout=PIPE, stdin=PIPE)
		proc.stdin.write("34")
		proc.stdin.close()
		re = proc.stdout.read()
		self.assertTrue((re == "The number 34 is even\n") or (re == "Enter a number: 34\nThe number 34 is even\n") or (re == "\nEnter a number: 34\nThe number 34 is even\n"), re)

	def test_ex02_1(self):
		proc = Popen("php ex02/oddeven.php", shell=True, stdout=PIPE, stdin=PIPE)
		proc.stdin.write("33")
		proc.stdin.close()
		re = proc.stdout.read()
		self.assertEqual((re == "The number 33 is odd\n") or (re == "Enter a number: 33\nThe number 33 is odd\n") or (re == "\nEnter a number: 33\nThe number 33 is odd\n"), re)

	def test_ex02_2(self):
		proc = Popen("php ex02/oddeven.php", shell=True, stdout=PIPE, stdin=PIPE)
		proc.stdin.write("a")
		proc.stdin.close()
		re = proc.stdout.read()
		self.assertTrue((re == "'a' is not a number\n") or (re == "Enter a number: a\n'a' is not a number\n") or (re == "\nEnter a number: a\n'a' is not a number\n"), re)

class Test_ex03(unittest.TestCase):
	def test_ex03_0(self):
		proc = Popen("php test_ex03.php 'Hello   World AAA'", shell=True, stdout=PIPE, stdin=PIPE)
		re = proc.stdout.read()
		# self.assertEqual("Array\n(\n    [0] => AAA\n    [1] => Hello\n    [2] => World\n)\n", re)
		self.assertTrue(("#!/usr/bin/php\nArray\n(\n    [0] => AAA\n    [1] => Hello\n    [2] => World\n)\n" == re) or (re == "Array\n(\n    [0] => AAA\n    [1] => Hello\n    [2] => World\n)\n"), re)

	def test_ex03_1(self):
		proc = Popen("php test_ex03.php 'aa AA hello   World AAA '", shell=True, stdout=PIPE, stdin=PIPE)
		re = proc.stdout.read()
		# self.assertEqual("Array\n(\n    [0] => \n    [1] => \n    [2] => AA\n    [3] => AAA\n    [4] => World\n    [5] => aa\n    [6] => hello\n)\n", re)
		self.assertTrue(("#!/usr/bin/php\nArray\n(\n    [0] => AA\n    [1] => AAA\n    [2] => World\n    [3] => aa\n    [4] => hello\n)\n" == re) or (re == "Array\n(\n    [0] => AA\n    [1] => AAA\n    [2] => World\n    [3] => aa\n    [4] => hello\n)\n"), re)

class Test_ex04(unittest.TestCase):
	def test_00(self):
		proc = Popen("php ex04/aff_param.php toto ahah foo bar quax", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("toto\nahah\nfoo\nbar\nquax\n", re)

	def test_01(self):
		proc = Popen("php ex04/aff_param.php this is \"two strings\" in the same   line", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("this\nis\ntwo strings\nin\nthe\nsame\nline\n", re)

	def test_02(self):
		proc = Popen("php ex04/aff_param.php", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("", re)

class Test_ex05(unittest.TestCase):
	def test_ex05_00(self):
		proc = Popen("php ex05/epur_str.php \"Hello,      how do you     do    ?\"", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("Hello, how do you do ?\n", re)

	def test_ex05_01(self):
		proc = Popen("php ex05/epur_str.php \"     Hello World     \"", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("Hello World\n", re)

	def test_ex05_02(self):
		proc = Popen("php ex05/epur_str.php", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("", re)

class Test_ex06(unittest.TestCase):
	def test_ex06_00(self):
		proc = Popen("php ex06/ssap.php", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("", re)

	def test_ex06_01(self):
		proc = Popen("php ex06/ssap.php foo bar", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("bar\nfoo\n", re)

	def test_ex06_02(self):
		proc = Popen("php ex06/ssap.php  foo bar \"yo man\" \"Here is my, two words\" Xibul", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("Here\nXibul\nbar\nfoo\nis\nman\nmy,\ntwo\nwords\nyo\n", re)

class Test_ex07(unittest.TestCase):
	def test_ex07_00(self):
		proc = Popen("php ex07/rostring.php", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("", re)

	def test_ex07_01(self):
		proc = Popen("php ex07/rostring.php sdfkjsdkl sdkjfskljdf", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("sdfkjsdkl\n", re)

	def test_ex07_02(self):
		proc = Popen("php ex07/rostring.php  \"hello world aaa\" fslkdjf", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("world aaa hello\n", re)

class Test_ex08(unittest.TestCase):
	def test_ex08_00(self):
		proc = Popen("php test_ex08_00.php \"\!/@#;^\" 42  \"Hello World\" hi zZzZzZz \"What are we doing now ?\"", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertTrue(("The array is not sorted\n" == re) or ("#!/usr/bin/php\nThe array is not sorted\n" == re))

	def test_ex08_01(self):
		proc = Popen("php test_ex08_01.php ", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertTrue(("The array is sorted\n" == re) or ("#!/usr/bin/php\nThe array is sorted\n" == re), re)
	def test_ex08_03(self):
		proc = Popen("php test_ex08_00.php a b c d e f", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertTrue(("The array is sorted\n" == re) or ("#!/usr/bin/php\nThe array is sorted\n" == re))
	def test_ex08_04(self):
		proc = Popen("php test_ex08_00.php b a c d e f", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertTrue(("The array is not sorted\n" == re) or ("#!/usr/bin/php\nThe array is not sorted\n" == re))

class Test_ex09(unittest.TestCase):
	def test_ex09_00(self):
		proc = Popen("php ex09/ssap2.php toto tutu 4234 \"_hop XXX\" '##' \"1948372 AhAhAh\"", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("AhAhAh\ntoto\ntutu\nXXX\n1948372\n4234\n##\n_hop\n", re)

	def test_ex09_01(self):
		proc = Popen("php ex09/ssap2.php 42 _TOT0 a4 Cb 'a#' _toto az 5v", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("az\na4\na#\nCb\n42\n5v\n_toto\n_TOT0\n", re)

	def test_ex09_02(self):
		proc = Popen("php ex09/ssap2.php", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("", re)

class Test_ex10(unittest.TestCase):
	def test_ex10_00(self):
		proc = Popen("php ex10/do_op.php", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("Incorrect Parameters\n", re)

	def test_ex10_01(self):
		proc = Popen("php ex10/do_op.php 1 + 3", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("4\n", re)

	def test_ex10_02(self):
		proc = Popen("php ex10/do_op.php ' 1'  ' +' ' 3'", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("4\n", re)

	def test_ex10_03(self):
		proc = Popen("php ex10/do_op.php ' 1'  ' *' ' 3'", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("3\n", re)

	def test_ex10_04(self):
		proc = Popen("php ex10/do_op.php 42 '% ' 3" , shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("0\n", re)

	def test_ex10_05(self):
		proc = Popen("php ex10/do_op.php 42 / 2" , shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("21\n", re)

	def test_ex10_06(self):
		proc = Popen("php ex10/do_op.php 8 - 2" , shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("6\n", re)

	def test_ex10_07(self):
		proc = Popen("php ex10/do_op.php  - 2" , shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("Incorrect Parameters\n", re)

	def test_ex10_08(self):
		proc = Popen("php ex10/do_op.php 8 2" , shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("Incorrect Parameters\n", re)

class Test_ex11(unittest.TestCase):
	def test_ex11_00(self):
		proc = Popen("php ex11/do_op_2.php", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("Incorrect Parameters\n", re)

	def test_ex11_01(self):
		proc = Popen("php ex11/do_op_2.php toto", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("Syntax Error\n", re)

	def test_ex11_02(self):
		proc = Popen("php ex11/do_op_2.php '42*2'", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("84\n", re)

	def test_ex11_03(self):
		proc = Popen("php ex11/do_op_2.php '  42 / 2 '", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("21\n", re)

	def test_ex11_04(self):
		proc = Popen("php ex11/do_op_2.php 'six6*7sept'", shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("Syntax Error\n", re)

	def test_ex11_05(self):
		proc = Popen("php ex11/do_op_2.php '`rm -rf ~/`;'" , shell=True, stdout=PIPE)
		re = proc.stdout.read()
		self.assertEqual("Syntax Error\n", re)

if __name__ == '__main__':
	unittest.main()
