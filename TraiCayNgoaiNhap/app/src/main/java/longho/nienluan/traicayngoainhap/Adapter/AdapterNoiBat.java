package longho.nienluan.traicayngoainhap.Adapter;

import android.content.Context;
import android.content.Intent;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.squareup.picasso.Callback;
import com.squareup.picasso.Picasso;

import java.text.DecimalFormat;
import java.util.List;

import longho.nienluan.traicayngoainhap.Model.ObjectClass.traicay;
import longho.nienluan.traicayngoainhap.R;
import longho.nienluan.traicayngoainhap.View.ChiTietTraiCay.ChiTietTraiCayActivity;

public class AdapterNoiBat extends RecyclerView.Adapter<AdapterNoiBat.ViewHolder> {

    Context context;
    List<traicay> traicayList;
    int layout;

    public AdapterNoiBat(Context context, int layout, List<traicay> traicays){
        this.context = context;
        this.traicayList = traicays;
        this.layout = layout;
    }

    public class ViewHolder extends RecyclerView.ViewHolder {
        TextView txtTenTraiCay,txtGiaBan,txtLuotMua;
        ImageView imgHinhTraiCay;
        ProgressBar progressBar;
        LinearLayout lnTraiCay;
        public ViewHolder(View itemView) {
            super(itemView);
            txtTenTraiCay = itemView.findViewById(R.id.txTenTraiCay);
            imgHinhTraiCay = itemView.findViewById(R.id.imHinhTraiCay);
            txtGiaBan = itemView.findViewById(R.id.txtGiaTraiCay);
            txtLuotMua = itemView.findViewById(R.id.txtLuotMua);
            progressBar = itemView.findViewById(R.id.pgbTraiCay);
            lnTraiCay = itemView.findViewById(R.id.lnTraiCay);
        }
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view = layoutInflater.inflate(layout,parent,false);
        ViewHolder viewHolder = new ViewHolder(view);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(@NonNull final ViewHolder holder, int position) {
        final traicay traicay = traicayList.get(position);
        if(traicay.getTenTraiCay().length()>10){
            holder.txtTenTraiCay.setText(traicay.getTenTraiCay().substring(0,11)+"...");
        }
        else {
            holder.txtTenTraiCay.setText(traicay.getTenTraiCay());
        }
        DecimalFormat formatter = new DecimalFormat("###,###");//định dạng tiền tệ
        String giaban = formatter.format(traicay.getGiaBan()) + " VNĐ";
        holder.txtGiaBan.setText(String.valueOf(giaban));
        holder.txtLuotMua.setText("Lượt mua: " + String.valueOf(traicay.getLuotMua()));
        Picasso.with(context).load(traicay.getHinhTraiCay()).resize(120,120).into(holder.imgHinhTraiCay, new Callback() {
            @Override
            public void onSuccess() {
                holder.progressBar.setVisibility(View.GONE);
            }
            @Override
            public void onError() {

            }
        });
        holder.lnTraiCay.setTag(traicay.getMaTraiCay());
        holder.lnTraiCay.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent iChiTietTraiCay = new Intent(context,ChiTietTraiCayActivity.class);
                iChiTietTraiCay.putExtra("matraicay", (int) v.getTag());
                context.startActivity(iChiTietTraiCay);
            }
        });

    }

    @Override
    public int getItemCount() {
        return traicayList.size();
    }


}