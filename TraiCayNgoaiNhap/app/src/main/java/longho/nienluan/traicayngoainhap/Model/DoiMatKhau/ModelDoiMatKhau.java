package longho.nienluan.traicayngoainhap.Model.DoiMatKhau;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.concurrent.ExecutionException;

import longho.nienluan.traicayngoainhap.DownloadInternet.DownloadJSON;
import longho.nienluan.traicayngoainhap.Model.ObjectClass.nguoidung;
import longho.nienluan.traicayngoainhap.View.TrangChu.TrangChuActivity;

public class ModelDoiMatKhau {
    public Boolean DoiMatKhauNguoiDung(nguoidung nguoiDung){
        String duongdan = TrangChuActivity.SERVER_NAME;
        List<HashMap<String, String>> atts = new ArrayList<>();

        boolean kiemtra = false;

        HashMap<String, String> hmHam = new HashMap<>();
        hmHam.put("ham","DoiMatKhauNguoiDung");
        HashMap<String, String> hmMaNguoiDung = new HashMap<>();
        hmMaNguoiDung.put("MaNguoiDung", String.valueOf(nguoiDung.getMaNguoiDung()));
        HashMap<String, String> hmMatKhau = new HashMap<>();
        hmMatKhau.put("MatKhau",nguoiDung.getMatKhau());

        atts.add(hmHam);
        atts.add(hmMaNguoiDung);
        atts.add(hmMatKhau);

        DownloadJSON downloadJSON = new DownloadJSON(duongdan,atts);
        downloadJSON.execute();

        try {
            String dulieuJson = downloadJSON.get();
            JSONObject jsonObject = new JSONObject(dulieuJson);
            String ketqua = jsonObject.getString("ketqua");
            if(ketqua.equals("true")){
                kiemtra = true;
            }else
                kiemtra = false;
        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return kiemtra;
    }
    public nguoidung LayThongTinNguoiDung(int manguoidung){
        nguoidung nguoidung = new nguoidung();

        List<HashMap<String,String>> attrs = new ArrayList<>();
        String dataJSON = "";

        String duongdan = TrangChuActivity.SERVER_NAME;

        HashMap<String,String> hsHam = new HashMap<>();
        hsHam.put("ham","LayThongTinNguoiDung");
        HashMap<String,String> hsMaND = new HashMap<>();
        hsMaND.put("MaNguoiDung", String.valueOf(manguoidung));

        attrs.add(hsHam);
        attrs.add(hsMaND);

        DownloadJSON downloadJSON = new DownloadJSON(duongdan,attrs);
        //end phương thức post
        downloadJSON.execute();

        try {
            dataJSON = downloadJSON.get();

            JSONObject jsonObject = new JSONObject(dataJSON);
            JSONArray jsonArrayTraiCay = jsonObject.getJSONArray("nguoidung");
            int dem = jsonArrayTraiCay.length();

            for (int i = 0; i<dem; i++){
                JSONObject object = jsonArrayTraiCay.getJSONObject(i);

                nguoidung.setTenNguoiDung(object.getString("TenNguoiDung"));
                nguoidung.setDiaChiND(object.getString("DiaChiND"));
                nguoidung.setSoDienThoaiND(object.getString("SoDienThoaiND"));
                nguoidung.setEmailND(object.getString("EmailND"));
                nguoidung.setGioiTinh(object.getInt("GioiTinh"));
                nguoidung.setMatKhau(object.getString("MatKhau"));
                nguoidung.setCauHoi(object.getString("CauHoi"));
                nguoidung.setCauTraLoi(object.getString("CauTraLoi"));
            }

        } catch (InterruptedException e) {
            e.printStackTrace();
        } catch (ExecutionException e) {
            e.printStackTrace();
        } catch (JSONException e) {
            e.printStackTrace();
        }

        return nguoidung;
    }
}
