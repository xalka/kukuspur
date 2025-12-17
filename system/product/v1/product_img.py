import os
import shutil
import pymysql

# Configuration
SOURCE_DIR = '/home/s/Downloads/mysoko20230130/sioka/public/uploads/products/photos/'
DEST_DIR = '/srv/web-data/evet/system/product/uploads/'

DB_CONFIG = {
    'host': 'localhost',
    'user': 'root',
    'password': 'NOV.2014.TEN',
    'database': 'evet',
    'charset': 'utf8mb4'
}

# Connect to database
conn = pymysql.connect(**DB_CONFIG)
cursor = conn.cursor(pymysql.cursors.DictCursor)

# Fetch all products
cursor.execute("SELECT productId, sku FROM product")
products = cursor.fetchall()

# Prepare list of image files
image_files = sorted([
    f for f in os.listdir(SOURCE_DIR)
    if f.lower().endswith(('.jpg', '.jpeg', '.png', '.gif'))
])

# Ensure destination directory exists
os.makedirs(DEST_DIR, exist_ok=True)

moved_count = 0
image_index = 0
total_images = len(image_files)

for product in products:
    if total_images == 0:
        print("⚠️ No images found in source directory.")
        break

    sku = product['sku']
    current_image = image_files[image_index]
    ext = os.path.splitext(current_image)[1]
    new_name = sku + ext

    source_path = os.path.join(SOURCE_DIR, current_image)
    dest_path = os.path.join(DEST_DIR, new_name)

    try:
        shutil.copy(source_path, dest_path)

        # Update the product table with the new image name
        cursor.execute(
            "UPDATE product SET img = %s WHERE productId = %s",
            (new_name, product['productId'])
        )
        conn.commit()

        print(f"✅ Copied: {current_image} → {new_name} & updated DB")
        moved_count += 1

        # Cycle to the next image, and wrap around if at end
        image_index = (image_index + 1) % total_images

    except Exception as e:
        print(f"❌ Error copying {current_image}: {e}")

print(f"\n🎯 Done. Copied and updated {moved_count} images.")

cursor.close()
conn.close()
