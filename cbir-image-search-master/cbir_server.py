
# CBIR image search engine server script

import json
from flask import Flask
from flask import request
from PIL import Image
import cv2
import numpy as np

import cbir_index

app = Flask(__name__)


@app.route("/hash-search", methods=["POST", "GET"])
def hash_search():
    if request.method == "POST":
        max_distance = int(request.form["max_distance"])
        query_hash_type = int(request.form["query_hash_type"])
        query_image = Image.open(request.files["query_image"].stream)  # PIL Image

        # perform search
        return cbir_index.hash_search(query_image, max_distance, query_hash_type)
    else:
        return "http method not allowed!"


# mục API tìm kiếm biểu đồ màu dựa trên khu vực
# tính toán tính năng màu cho hình ảnh đã tải lên và nhận các hình ảnh tương tự từ nguồn hình ảnh
# trả lại chuỗi json 
@app.route("/color-histogram-search", methods=["POST", "GET"])
def color_histogram_search():
    if request.method == "POST":
        limit = int(request.form["limit"])
        query_image = Image.open(request.files["query_image"].stream)  # PIL Image
        query_image = cv2.cvtColor(np.asarray(query_image),cv2.COLOR_RGB2BGR)  # opencv Image
        
        # perform search
        
        return cbir_index.color_histogram_search(query_image, limit)
    else:
        return "http method not allowed!"


if __name__ == "__main__":
    cbir_index.init_index()
    app.run(host="0.0.0.0", port=8080, debug=True)
    
    
    
    
    # sau khi xử lý hình ảnh, ta chuyển hướng đến trang tìm kiếm bằng hình 
    # ảnh hiển thị ra các kết quả bằng cách sử dụng js cắt chuỗi và 
    # import vào php lấy thông tin sản phẩm
