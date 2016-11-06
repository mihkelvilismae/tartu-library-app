package com.example.mihkel.libraryapp.Activities;

import android.app.Activity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import com.example.mihkel.libraryapp.Various.AppManagerSingleton;
import com.example.mihkel.libraryapp.Various.DatabaseLayerImpl;
import com.example.mihkel.libraryapp.Item.Book;
import com.example.mihkel.libraryapp.Item.Item;
import com.example.mihkel.libraryapp.Various.ListAdapter;
import com.example.mihkel.libraryapp.R;

import java.util.ArrayList;
import java.util.List;

public class BooksListActivity extends Activity {
    ListView listView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mandatory_list);

        DatabaseLayerImpl databaseLayer = new DatabaseLayerImpl();

        // Get ListView object from xml
        listView = (ListView) findViewById(R.id.schoolsList);
        List<Item> list = new ArrayList<Item>(databaseLayer.getReadingList(AppManagerSingleton.selectedClassId).values());
        ListAdapter adapter = new ListAdapter(this, R.layout.table_row, list);



//            ArrayAdapter<String> adapter = new ArrayAdapter<String>(this,
//              android.R.layout.simple_list_item_1, android.R.id.text1, list);


        // Assign adapter to ListView
        listView.setAdapter(adapter);

        // ListView Item Click Listener
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {

            @Override
            public void onItemClick(AdapterView<?> parent, View view,
                                    int position, long id) {

                // ListView Clicked item index
                int itemPosition = position;

                // ListView Clicked item value
                Book itemValue = (Book) listView.getItemAtPosition(position);

                // Show Alert
                Toast.makeText(getApplicationContext(),
                        "Position :" + itemPosition + "  ListItem : " + itemValue, Toast.LENGTH_LONG)
                        .show();
//                    Intent calendarStartIntent = new Intent(this, BooksListActivity.class);
//                    startActivity(calendarStartIntent);
//        }
//                if (true || !DatabaseManagerSingleton.getInstance().hasClassesInSchool(AppManagerSingleton.selectedSchoolId))
//                    fetchDataFromServer(itemValue.getId());
//                else
//                    startNextActivity();

            }

        });
    }




}