
# tinh toán color histogram feature, refer to https://www.pyimagesearch.com/2014/12/01/complete-guide-building-image-search-engine-python-opencv/

import numpy as np
import cv2

# không giang màu hsv
# HSV được đặt tên như vậy cho ba giá trị: màu sắc, độ bão hòa và giá trị.
# có thể thai đổi hiệu chihr 
bins = (8, 12, 3)

# tính toán đặc trưng biểu đồ màu dựa trên vùng, kích thước vectơ đặc trưng là bins[0]*bins[1]*bins[2]*5
# image: ảnh đầu vào cần tính toán, OpenCV Image
def describe(image):
    # chuyển đổi hình ảnh sang không gian màu HSV và khởi tạo
    # các tính năng được sử dụng để định lượng hình ảnh
    image = cv2.cvtColor(image, cv2.COLOR_BGR2HSV)
    features = []

    # lấy kích thước và tính trung tâm của hình ảnh
    (h, w) = image.shape[:2]
    (cX, cY) = (int(w * 0.5), int(h * 0.5))

    # chia hình ảnh thành bốn hình chữ nhật/phân đoạn (trên-trái,
    # trên-phải, dưới-phải, dưới-trái)
    segments = [(0, cX, 0, cY), (cX, w, 0, cY), (cX, w, cY, h),
        (0, cX, cY, h)]

    # xây dựng một mặt nạ hình elip đại diện cho trung tâm của
    # ảnh
    (axesX, axesY) = (int(w * 0.75) // 2, int(h * 0.75) // 2)
    ellipMask = np.zeros(image.shape[:2], dtype = "uint8")
    cv2.ellipse(ellipMask, (cX, cY), (axesX, axesY), 0, 0, 360, 255, -1)

    # lặp qua các đoạn
    for (startX, endX, startY, endY) in segments:
        # tạo mặt nạ cho mỗi góc của hình ảnh, trừ đi
        # tâm elip từ nó
        cornerMask = np.zeros(image.shape[:2], dtype = "uint8")
        cv2.rectangle(cornerMask, (startX, startY), (endX, endY), 255, -1)
        cornerMask = cv2.subtract(cornerMask, ellipMask)

        # trích xuất một biểu đồ màu từ hình ảnh, sau đó cập nhật
        # véc tơ đặc trưng
        hist = histogram(image, cornerMask)
        features.extend(hist)

    # trích xuất biểu đồ màu từ vùng hình elip và
    # cập nhật véc tơ đặc trưng
    hist = histogram(image, ellipMask)
    features.extend(hist)

    # trả về véc tơ đặc trưng
    # vectơ chứa 4 vùng góc và 1 vùng trung tâm, tổng cộng 5 phần
    # kích thước bằng bins[0]*bins[1]*bins[2]*5
    return features


# tính toán tính năng biểu đồ màu cho một vùng
# image: hình ảnh được tính toán
# mask: vùng cần tính
def histogram(image, mask):
    # trích xuất biểu đồ màu 3D từ vùng bị che của
    # hình ảnh, sử dụng số lượng thùng được cung cấp trên mỗi kênh
    hist = cv2.calcHist([image], [0, 1, 2], mask, bins, [0, 180, 0, 256, 0, 256])

    # bình tuhuongf biểu đồ
    hist = cv2.normalize(hist, hist).flatten()

    # return the histogram
    return hist
