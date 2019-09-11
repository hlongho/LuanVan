package longho.nienluan.traicayngoainhap.Adapter;

import android.content.Context;
import android.support.annotation.NonNull;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.List;

import longho.nienluan.traicayngoainhap.Model.ObjectClass.DonDatHang;
import longho.nienluan.traicayngoainhap.R;

public class AdapterDonDatHang extends RecyclerView.Adapter<AdapterDonDatHang.ViewHolderDonDatHang> {

    List<DonDatHang> donDatHangList;
    Context context;

    public AdapterDonDatHang(Context context, List<DonDatHang> donDatHangList){
        this.donDatHangList = donDatHangList;
        this.context = context;
    }

    public class ViewHolderDonDatHang extends RecyclerView.ViewHolder {

        TextView txtMaDDH, txtNgayDat, txtNgayGiao, txtTrangThaiGiaoHang;
        RecyclerView rcvDanhSachTraiCayHD;

        public ViewHolderDonDatHang(View itemView) {
            super(itemView);

            txtMaDDH = itemView.findViewById(R.id.txtMaDDH);
            txtNgayDat = itemView.findViewById(R.id.txtNgayDat);
            txtNgayGiao = itemView.findViewById(R.id.txtNgayGiao);
            txtTrangThaiGiaoHang = itemView.findViewById(R.id.txtTrangThaiGiaoHang);
            rcvDanhSachTraiCayHD = itemView.findViewById(R.id.rcvDanhSachTraiCayHD);

        }
    }

    @NonNull
    @Override
    public ViewHolderDonDatHang onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view = layoutInflater.inflate(R.layout.custom_item_dondathang,parent,false);

        ViewHolderDonDatHang viewHolderDonDatHang = new ViewHolderDonDatHang(view);

        return viewHolderDonDatHang;
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolderDonDatHang holder, int position) {

        DonDatHang donDatHang = donDatHangList.get(position);
        holder.txtMaDDH.setText("Mã đơn hàng: " + String.valueOf(donDatHang.getMaDDH()));
        holder.txtNgayDat.setText("Ngày đặt: " + donDatHang.getNgayDat());
        holder.txtNgayGiao.setText("Dự kiến ngày giao: " + donDatHang.getNgayGiao());
        holder.txtTrangThaiGiaoHang.setText("Trạng thái: " + donDatHang.getTrangThaiGiao());

        AdapterDonDatHangSanPham adapterDonDatHangSanPham =new AdapterDonDatHangSanPham(context,donDatHang.getChiTietDDHList());
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(context,LinearLayoutManager.HORIZONTAL,false);
        holder.rcvDanhSachTraiCayHD.setLayoutManager(layoutManager);
        holder.rcvDanhSachTraiCayHD.setAdapter(adapterDonDatHangSanPham);
    }

    @Override
    public int getItemCount() {
        return donDatHangList.size();
    }


}