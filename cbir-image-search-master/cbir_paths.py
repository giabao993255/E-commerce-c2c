    
import os

image_types = (".jpg", ".jpeg", ".png", ".bmp", ".tif", ".tiff")

def list_images(basePath, contains=None):
    # trả về tập hợp các tệp hợp lệ
    return list_files(basePath, validExts=image_types, contains=contains)

def list_files(basePath, validExts=None, contains=None):
    # lặp qua cấu trúc thư mục
    for (rootDir, dirNames, filenames) in os.walk(basePath):
        # lặp qua các tên tệp trong thư mục hiện tại
        for filename in filenames:
            # nếu chuỗi chứa không phải là none và tên tệp không chứa
            # chuỗi được cung cấp, sau đó bỏ qua tệp
            if contains is not None and filename.find(contains) == -1:
                continue

            # xác định phần mở rộng tệp của tệp hiện tại
            ext = filename[filename.rfind("."):].lower()

            # kiểm tra xem tệp có phải là hình ảnh hay không và cần được xử lý
            if validExts is None or ext.endswith(validExts):
                # xây dựng đường dẫn đến hình ảnh và mang lại nó
                imagePath = os.path.join(rootDir,filename)
                yield imagePath