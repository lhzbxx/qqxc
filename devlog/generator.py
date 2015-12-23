#!/usr/bin/env python
# -*- coding: utf-8 -*-
# @Author: LuHao
# @Date:   2015-11-30 23:11:39
# @Last Modified by:   LuHao
# @Last Modified time: 2015-12-01 00:35:54

import time
import os
import getopt
import sys

class Log:
    """规范日志类"""

    fn = ''
    au = ''
    dt = ''
    con = ''

    def __init__(self):
        current_date = self.fetch_current_date()
        self.fn = current_date + '.md'
        self.au = 'Lu Hao'
        self.dt = current_date
        self.con = self.fetch_template_content()
        self.generate_log_file()

    def check_file_exist(self):
        cur_dir_list = os.listdir(os.getcwd())
        if cur_dir_list.count(self.fn) == 0:
            return False
        return True

    def fetch_current_date(self):
        return time.strftime('%Y-%m-%d')

    def fetch_template_content(self):
        f = open('template.txt', 'r')
        tpl = f.read()
        return tpl

    def replace_template_content(self):
        self.con = self.con.replace('DATE', self.dt)
        self.con = self.con.replace('AUTHOR', self.au)

    def generate_log_file(self):
        if self.check_file_exist():
            print u'文件已存在 TuT'
        else:
            f = open(self.fn, 'w')
            self.replace_template_content()
            f.write(self.con)
            print u'文件已生成 ^V^'

if __name__ == '__main__':
    # python scriptname.py -f 'hello' --directory-prefix=/home -t --form at 'a' 'b'
    shortargs = 'f:t'
    longargs = ['directory-prefix=', 'format', '--f_long=']
    opts, args = getopt.getopt(sys.argv[1:], shortargs, longargs)
    log = Log()


