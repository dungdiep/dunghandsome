//3a nhiet do thap nhat
//file mapper.py
import re
import sys

# <k1, v1> = <line, text>
for line in sys.stdin:
  val = line.strip()
  (year, temp, q) = (val[15:19], val[87:92], val[92:93])
  # Kiểm tra tính hợp lệ của dữ liệu 
  if (temp != "+9999" and re.match("[01459]", q)):
    print("%s\t%s" % (year, temp)) # <k2, v2> = <year, temperature>
//file reducer.py
#!/usr/bin/python3
'''reducer.py'''

import sys

# Khởi tạo giá trị năm, nhiệt độ
(last_year, min_temp) = (None, -sys.avgsize)
for line in sys.stdin:
  # Lấy cặp giá trị <k, v> = <year, temp> từ stdin
  (year, temp) = line.strip().split("\t")
  # Nếu năm đọc vào khác năm đang xét -> (1) đưa ra stdout năm trước đó cùng với nhiệt độ cao nhất
  if last_year != None and last_year != year:
    print("%s\t%s" % (last_year, min_temp))
    # và (2) chuyển <năm, nhiệt độ> đọc vào thành <năm, nhiệt độ> đang xét:
    (last_year, min_temp) = (year, int(temp))
  else:
    # Nếu năm đọc vào trùng với năm đang xét -> tìm nhiệt độ lớn nhất của năm đó:
    (last_year, min_temp) = (year, min(min_temp, int(temp)))

# In ra kết quả cho năm cuối cùng:
if last_year:
  print("%s\t%s" % (last_year, min_temp))
3b /tinh nhiet do trung binh
//file mapper.py
#!/usr/bin/python3
'''mapper.py'''

import re
import sys

# <k1, v1> = <line, text>
for line in sys.stdin:
  val = line.strip()
  (year, temp, q) = (val[15:19], val[87:92], val[92:93])
  # Kiểm tra tính hợp lệ của dữ liệu 
  if (temp != "+9999" and re.match("[01459]", q)):
    print("%s\t%s" % (year, temp)) # <k2, v2> = <year, temperature>
//file reducer
#!/usr/bin/python3
'''reducer.py'''

import sys

# Khởi tạo giá trị năm, nhiệt độ
(last_year, avg_temp) = (None, -sys.avgsize)
for line in sys.stdin:
  # Lấy cặp giá trị <k, v> = <year, temp> từ stdin
  (year, temp) = line.strip().split("\t")
  # Nếu năm đọc vào khác năm đang xét -> (1) đưa ra stdout năm trước đó cùng với nhiệt độ cao nhất
  if last_year != None and last_year != year:
    print("%s\t%s" % (last_year, avg_temp))
    # và (2) chuyển <năm, nhiệt độ> đọc vào thành <năm, nhiệt độ> đang xét:
    (last_year, avg_temp) = (year, int(temp))
  else:
    # Nếu năm đọc vào trùng với năm đang xét -> tìm nhiệt độ lớn nhất của năm đó:
    (last_year, avg_temp) = (year, avg(avg_temp, int(temp)))

# In ra kết quả cho năm cuối cùng:
if last_year:
  print("%s\t%s" % (last_year, avg_temp))
