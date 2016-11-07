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

public class TextAutocompleteListAdapter extends ArrayAdapter<Item> {

    Integer mTagType;
    public TextAutocompleteListAdapter(Context context, int textViewResourceId) {
        super(context, textViewResourceId);
    }

    public TextAutocompleteListAdapter(Context context, int resource, List<Item> items, int tagType) {
        super(context, resource, items);
        mTagType = tagType;
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

        v.setTag(R.id.TAG_OBJECT, p);
        v.setTag(R.id.TAG_TYPE, mTagType);

        if (p != null) {
            TextView tt1 = (TextView) v.findViewById(R.id.dropdownItem);
//            TextView tt2 = (TextView) v.findViewById(R.id.categoryId);
//            TextView tt3 = (TextView) v.findViewById(R.id.description);

            if (tt1 != null) {
//                tt1.setText("i");
                tt1.setText(p.getName()+"....");
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