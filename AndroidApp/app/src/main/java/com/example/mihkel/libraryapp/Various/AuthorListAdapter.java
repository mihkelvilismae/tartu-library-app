package com.example.mihkel.libraryapp.Various;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import com.example.mihkel.libraryapp.Item.Item;
import com.example.mihkel.libraryapp.R;

import java.util.List;

public class AuthorListAdapter extends ArrayAdapter<Item> {

    public AuthorListAdapter(Context context, int textViewResourceId) {
        super(context, textViewResourceId);
    }

    public AuthorListAdapter(Context context, int resource, List<Item> items) {
        super(context, resource, items);
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        View v = convertView;

        if (v == null) {
            LayoutInflater vi;
            vi = LayoutInflater.from(getContext());
            v = vi.inflate(R.layout.dropdown, null);
        }

        Item p = getItem(position);

        if (p != null) {
            TextView tt1 = (TextView) v.findViewById(R.id.dropdownItem);
//            TextView tt2 = (TextView) v.findViewById(R.id.categoryId);
//            TextView tt3 = (TextView) v.findViewById(R.id.description);

            if (tt1 != null) {
//                tt1.setText("i");
                tt1.setText(p.getName());
            }

//            if (tt2 != null) {
//                tt2.setText("xxx");
//                tt2.setText(p.getCategory().getId());
//            }
//
//            if (tt3 != null) {
//                tt3.setText(p.getName());
//                tt3.setText(p.getDescription());
//            }
        }

        return v;
    }

}